(function(){let a=1,s=!1;const g=async()=>{if(s)return;const t=document.querySelector("#load-more");t&&(t.textContent="Loading...");const n=await fetch(elimin8r.url+"/wp-json/wp/v2/ifs/"+elimin8r.post_type+"?page="+(a+1)+"&per_page="+elimin8r.posts_per_page);if(a++,!n.ok){s=!0;return}const l=await n.json();if(l.length===0){s=!0,t&&(t.textContent="No more posts");return}p(l)},d=()=>{const t=document.querySelector("#load-more");t&&t.addEventListener("click",g)};d();const p=t=>{const n=document.querySelector("#load-more");n&&n.remove(),document.title=document.title+" - Page "+a,document.title=document.title.replace(" - Page "+(a-1),"");const l=t,m=document.querySelector(".blog-content"),r=m.querySelector("article.hentry");let i="";r&&(r.classList.contains("blog-compact")?i="blog-compact":r.classList.contains("blog-full")?i="blog-full":r.classList.contains("blog-grid")&&(i="blog-grid")),n&&(n.textContent="Load more"),l.forEach(e=>{const o=document.createElement("article");o.classList.add("post"),o.classList.add("ifs-post"),o.classList.add("hentry"),o.classList.add(i);const h=e.thumbnail?e.thumbnail:"/wp-content/themes/elimin8r/dist/images/placeholder-image.svg",u=` <a href="${e.permalink}">Continue reading</a>`;i==="blog-compact"?e.excerpt=e.excerpt.split(" ").slice(0,35).join(" ")+u:e.excerpt=e.excerpt.split(" ").slice(0,55).join(" ")+u,o.innerHTML=`
                                <a href="${e.permalink}" title="${e.title}">
                                    <figure class="post-thumbnail">
                                        <img width="300" height="200" src="${h}" class="attachment-medium size-medium wp-post-image" alt="" decoding="async">
                                    </figure>
                                </a>

                                <div class="article-content">
                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="${e.permalink}" rel="bookmark">${e.title}</a></h2>
                                    </header>

                                    <div class="entry-content">
                                        ${e.excerpt}
                                    </div>
                                </div>
                            `,m.appendChild(o)});const f=document.querySelector(".site-main"),c=document.createElement("button");c.id="load-more",c.textContent="Load more",f.appendChild(c),d()}})();
