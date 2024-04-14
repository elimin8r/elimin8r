(function () {
    let currentPage = 1;
    let noMorePosts = false;

    const getNextPage = async () => {
        if (noMorePosts) {
            return;
        }

        console.log("infinite scroll", "Fetching next page...");

        const response = await fetch( elimin8r.url + "/wp-json/wp/v2/ifs/" + elimin8r.post_type + "?page=" + (currentPage + 1) + "&per_page=" + elimin8r.posts_per_page );

        currentPage++;

        if (!response.ok) {
            noMorePosts = true;
            return;
        }

        const data = await response.json();

        if (data.length === 0) {
            noMorePosts = true;

            // Change load-more button text to "No more posts"
            const loadMoreButton = document.querySelector("#load-more");
            if (loadMoreButton) {
                loadMoreButton.textContent = "No more posts";
            }

            return;
        }

        const postsContainer = document.querySelector(".blog-content");
        const loadingSpinner = document.createElement("div");
        loadingSpinner.classList.add("loading-spinner");
        postsContainer.appendChild(loadingSpinner);

        displayNextPage(data);
    }

    const addLoadMoreButtonEventListener = () => {
        const loadMoreButton = document.querySelector("#load-more");
        if (loadMoreButton) {
            loadMoreButton.addEventListener("click", getNextPage);
        }
    }

    // Call this function when the page first loads
    addLoadMoreButtonEventListener();

    const displayNextPage = (data) => {
        // Remove the load-more button
        const loadMoreButton = document.querySelector("#load-more");
        if (loadMoreButton) {
            loadMoreButton.remove();
        }

        // Add - Page 2 to the browser title
        document.title = document.title + " - Page " + currentPage;
        document.title = document.title.replace(" - Page " + (currentPage - 1), "");

        const posts = data;
        const postsContainer = document.querySelector(".blog-content");
        const article = postsContainer.querySelector("article.hentry");

        let postClass = "";
        if (article) {
            if (article.classList.contains("blog-compact")) {
                postClass = "blog-compact";
            } else if (article.classList.contains("blog-full")) {
                postClass = "blog-full";
            } else if (article.classList.contains("blog-grid")) {
                postClass = "blog-grid";
            }
        }

        const loadingSpinner = postsContainer.querySelector(".loading-spinner");
        if (loadingSpinner) {
            loadingSpinner.remove();
        }

        posts.forEach(post => {
            const postElement = document.createElement("article");
            postElement.classList.add("post");
            postElement.classList.add("ifs-post");
            postElement.classList.add(postClass);

            const thumbnail = post.thumbnail ? post.thumbnail : "/wp-content/themes/elimin8r/dist/images/placeholder-image.svg";

            const readMore = ` <a href="${post.permalink}">Continue reading</a>`;

            // Cap the excerpt length to 35 words for blog-compact else 55
            if (postClass === "blog-compact") {
                post.excerpt = post.excerpt.split(" ").slice(0, 35).join(" ") + readMore;
            } else {
                post.excerpt = post.excerpt.split(" ").slice(0, 55).join(" ") + readMore;
            }

            postElement.innerHTML = `
                                <a href="${post.permalink}" title="${post.title}">
                                    <figure class="post-thumbnail">
                                        <img width="300" height="200" src="${thumbnail}" class="attachment-medium size-medium wp-post-image" alt="" decoding="async">
                                    </figure>
                                </a>

                                <div class="article-content">
                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="${post.permalink}" rel="bookmark">${post.title}</a></h2>
                                    </header>

                                    <div class="entry-content">
                                        ${post.excerpt}
                                    </div>
                                </div>
                            `;

            postsContainer.appendChild(postElement);
        });

        // Add the load-more button
        const newLoadMoreButton = document.createElement("button");
        newLoadMoreButton.id = "load-more";
        newLoadMoreButton.textContent = "Load more";
        postsContainer.appendChild(newLoadMoreButton);

        addLoadMoreButtonEventListener();
    }
}());