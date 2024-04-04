<?php

// Add Enable infinite scroll checkbox to Reading settings
function lmn8r_add_enable_infinite_scroll_checkbox() {
    add_settings_field( 'enable_infinite_scroll_checkbox', 'Enable infinite scroll', 'lmn8r_enable_infinite_scroll_checkbox_callback', 'reading', 'default' );
    register_setting( 'reading', 'enable_infinite_scroll_checkbox' );
}

// Enable infinite scroll checkbox callback
function lmn8r_enable_infinite_scroll_checkbox_callback() {
    $emojis = get_option( 'enable_infinite_scroll_checkbox' );
    echo '<input type="checkbox" name="enable_infinite_scroll_checkbox" value="1" ' . checked( 1, $emojis, false ) . ' />';
}
add_action( 'admin_init', 'lmn8r_add_enable_infinite_scroll_checkbox' );

// Enable infinite scroll
function lmn8r_enable_infinite_scroll() {
    if ( get_option( 'enable_infinite_scroll_checkbox' ) !== '' ) {
        // Get the post type
        $post_type = get_post_type();

        if ( $post_type === 'post' ) {
            $post_type_slug = 'posts';
        } else {
            $post_type_slug = $post_type;
        }

        // Get the URL
        $url = get_site_url();

        // Get the 'Blog pages show at most' option
        $posts_per_page = get_option( 'posts_per_page' );

        $script = '<script id="lmn8r-infinite-scroll" defer>
            let currentPage = 1;
            let noMorePosts = false;

            window.addEventListener("scroll", function(ev) {
                if (!noMorePosts && (window.innerHeight + window.scrollY) >= document.documentElement.scrollHeight) {
                    getNextPage();
                }
            });
            
            const getNextPage = async () => {
                if (noMorePosts) return;

                const url = window.location.origin;
                const response = await fetch("' . $url . '/wp-json/wp/v2/' . $post_type_slug . '?per_page=' . $posts_per_page . '&page=" + (++currentPage));

                if (!response.ok) {
                    noMorePosts = true;
                    return;
                }

                const data = await response.json();

                if (data.length === 0) {
                    noMorePosts = true;
                    return;
                }

                const postsContainer = document.querySelector(".blog-content");
                const loadingSpinner = document.createElement("div");
                loadingSpinner.classList.add("loading-spinner");
                postsContainer.appendChild(loadingSpinner);

                displayNextPage(data);
            }

            const displayNextPage = (data) => {
                const posts = data;
                const postsContainer = document.querySelector(".blog-content");
                const article = postsContainer.querySelector(".post");

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
                    fetch(post._links["wp:featuredmedia"][0].href)
                        .then(response => response.json())
                        .then(media => {
                            let postExcerpt = post.excerpt.rendered
                            if (postClass === "blog-compact") {
                                let words = postExcerpt.split(" ");
                                if (words.length > 35) {
                                    postExcerpt = words.slice(0, 35).join(" ") + ` <a href="${post.link}">Continue reading</a>`;
                                }
                            }

                            postElement.innerHTML = `
                                <a href="${post.link}" title="${post.title.rendered}">
                                    <figure class="post-thumbnail">
                                        <img width="300" height="200" src="${media.source_url}" class="attachment-medium size-medium wp-post-image" alt="" decoding="async">
                                    </figure>
                                </a>

                                <div class="article-content">
                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="${post.link}" rel="bookmark">${post.title.rendered}</a></h2>
                                    </header>

                                    <div class="entry-content">
                                        ${postExcerpt}
                                    </div>
                                </div>
                            `;
                        });

                    postsContainer.appendChild(postElement);
                });
            }
        </script>';

        echo $script;
    }
}
add_action( 'wp_footer', 'lmn8r_enable_infinite_scroll' );