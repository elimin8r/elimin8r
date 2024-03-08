<?php

// Add Enable infinite scroll checkbox to Reading settings
function add_enable_infinite_scroll_checkbox() {
    add_settings_field( 'enable_infinite_scroll_checkbox', 'Enable infinite scroll', 'enable_infinite_scroll_checkbox_callback', 'reading', 'default' );
    register_setting( 'reading', 'enable_infinite_scroll_checkbox' );
}

// Enable infinite scroll checkbox callback
function enable_infinite_scroll_checkbox_callback() {
    $emojis = get_option( 'enable_infinite_scroll_checkbox' );
    echo '<input type="checkbox" name="enable_infinite_scroll_checkbox" value="1" ' . checked( 1, $emojis, false ) . ' />';
}
add_action( 'admin_init', 'add_enable_infinite_scroll_checkbox' );

// Enable infinite scroll
function enable_infinite_scroll() {
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

        echo '<script>
            let currentPage = 1;
            let noMorePosts = false;

            window.onscroll = function(ev) {
                if (!noMorePosts && (window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                    getNextPage();
                }
            };
            
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

                displayNextPage(data);
            }

            const displayNextPage = (data) => {
                const posts = data;
                const postsContainer = document.querySelector(".blog-content");
                const article = postsContainer.querySelector(".post");

                console.log(data);

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

                posts.forEach(post => {
                    const postElement = document.createElement("article");
                    postElement.classList.add("post");
                    postElement.classList.add("ifs-post");
                    postElement.classList.add(postClass);
                    fetch(post._links["wp:featuredmedia"][0].href)
                        .then(response => response.json())
                        .then(media => {
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
                                        ${post.excerpt.rendered}
                                    </div>
                                </div>
                            `;
                        });

                    postsContainer.appendChild(postElement);
                });
            }
        </script>';
    }
}
add_action( 'wp_footer', 'enable_infinite_scroll' );