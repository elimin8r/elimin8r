(function(){const e=document.getElementById("site-navigation");if(!e)return;const n=e.getElementsByTagName("button")[0];if(typeof n>"u")return;const s=e.getElementsByTagName("ul")[0];if(typeof s>"u"){n.style.display="none";return}s.classList.contains("nav-menu")||s.classList.add("nav-menu"),n.addEventListener("click",function(){e.classList.toggle("toggled"),n.getAttribute("aria-expanded")==="true"?n.setAttribute("aria-expanded","false"):n.setAttribute("aria-expanded","true")}),document.addEventListener("click",function(i){e.contains(i.target)||(e.classList.remove("toggled"),n.setAttribute("aria-expanded","false"))});const t=s.getElementsByTagName("a"),a=s.querySelectorAll(".menu-item-has-children > a, .page_item_has_children > a");for(const i of t)i.addEventListener("focus",l,!0),i.addEventListener("blur",l,!0);for(const i of a)i.addEventListener("touchstart",l,!1,{passive:!0}),i.addEventListener("click",l);function l(i){if(i.type==="touchstart"||i.type==="click"){const c=this.parentNode;i.preventDefault();for(const u of c.parentNode.children)c!==u&&u.classList.remove("focus");c.classList.toggle("focus")}}})();const h=document.querySelector(".site-header .search-toggle");document.querySelector(".site-header .search-field");const o=document.querySelector(".site-header .search-field");h.onclick=()=>{o.classList.toggle("search-active"),o.classList.contains("search-active")&&o.focus()};window.onload=()=>{o.value=""};const r=document.querySelector(".search-field");r&&r.addEventListener("keyup",()=>f(r));const d=document.querySelector(".wp-block-search__input");d&&d.addEventListener("keyup",()=>f(d));const f=async e=>{const n=window.location.origin,t=await(await fetch(n+"/wp-json/wp/v2/search/?search="+e.value)).json();m(e,t)},m=(e,n)=>{if(!e.parentElement.querySelector(".search-autocomplete")){let t=document.createElement("ul");t.classList.add("search-autocomplete"),e.parentElement.appendChild(t);let a=e.offsetHeight;t.style.top=a+"px"}const s=e.parentElement.querySelector(".search-autocomplete");if(s.innerHTML="",s.style.display="block",n.length===0){let t=document.createElement("li");t.innerHTML="No results found",s.appendChild(t)}else for(let t=0;t<n.length;t++)if(e.value.length>0){let a=document.createElement("li"),l=document.createElement("a");l.innerHTML+=n[t].title,l.href=n[t].url,a.appendChild(l),s.appendChild(a)}else s.style.display="none",s.innerHTML=""};
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoic2NyaXB0cy1BRzNHby1VNC5qcyIsInNvdXJjZXMiOlsiLi4vLi4vcmVzb3VyY2VzL2pzL25hdmlnYXRpb24uanMiLCIuLi8uLi9yZXNvdXJjZXMvanMvc2VhcmNoLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIi8qKlxuICogRmlsZSBuYXZpZ2F0aW9uLmpzLlxuICpcbiAqIEhhbmRsZXMgdG9nZ2xpbmcgdGhlIG5hdmlnYXRpb24gbWVudSBmb3Igc21hbGwgc2NyZWVucyBhbmQgZW5hYmxlcyBUQUIga2V5XG4gKiBuYXZpZ2F0aW9uIHN1cHBvcnQgZm9yIGRyb3Bkb3duIG1lbnVzLlxuICovXG4oIGZ1bmN0aW9uKCkge1xuXHRjb25zdCBzaXRlTmF2aWdhdGlvbiA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCAnc2l0ZS1uYXZpZ2F0aW9uJyApO1xuXG5cdC8vIFJldHVybiBlYXJseSBpZiB0aGUgbmF2aWdhdGlvbiBkb2Vzbid0IGV4aXN0LlxuXHRpZiAoICEgc2l0ZU5hdmlnYXRpb24gKSB7XG5cdFx0cmV0dXJuO1xuXHR9XG5cblx0Y29uc3QgYnV0dG9uID0gc2l0ZU5hdmlnYXRpb24uZ2V0RWxlbWVudHNCeVRhZ05hbWUoICdidXR0b24nIClbIDAgXTtcblxuXHQvLyBSZXR1cm4gZWFybHkgaWYgdGhlIGJ1dHRvbiBkb2Vzbid0IGV4aXN0LlxuXHRpZiAoICd1bmRlZmluZWQnID09PSB0eXBlb2YgYnV0dG9uICkge1xuXHRcdHJldHVybjtcblx0fVxuXG5cdGNvbnN0IG1lbnUgPSBzaXRlTmF2aWdhdGlvbi5nZXRFbGVtZW50c0J5VGFnTmFtZSggJ3VsJyApWyAwIF07XG5cblx0Ly8gSGlkZSBtZW51IHRvZ2dsZSBidXR0b24gaWYgbWVudSBpcyBlbXB0eSBhbmQgcmV0dXJuIGVhcmx5LlxuXHRpZiAoICd1bmRlZmluZWQnID09PSB0eXBlb2YgbWVudSApIHtcblx0XHRidXR0b24uc3R5bGUuZGlzcGxheSA9ICdub25lJztcblx0XHRyZXR1cm47XG5cdH1cblxuXHRpZiAoICEgbWVudS5jbGFzc0xpc3QuY29udGFpbnMoICduYXYtbWVudScgKSApIHtcblx0XHRtZW51LmNsYXNzTGlzdC5hZGQoICduYXYtbWVudScgKTtcblx0fVxuXG5cdC8vIFRvZ2dsZSB0aGUgLnRvZ2dsZWQgY2xhc3MgYW5kIHRoZSBhcmlhLWV4cGFuZGVkIHZhbHVlIGVhY2ggdGltZSB0aGUgYnV0dG9uIGlzIGNsaWNrZWQuXG5cdGJ1dHRvbi5hZGRFdmVudExpc3RlbmVyKCAnY2xpY2snLCBmdW5jdGlvbigpIHtcblx0XHRzaXRlTmF2aWdhdGlvbi5jbGFzc0xpc3QudG9nZ2xlKCAndG9nZ2xlZCcgKTtcblxuXHRcdGlmICggYnV0dG9uLmdldEF0dHJpYnV0ZSggJ2FyaWEtZXhwYW5kZWQnICkgPT09ICd0cnVlJyApIHtcblx0XHRcdGJ1dHRvbi5zZXRBdHRyaWJ1dGUoICdhcmlhLWV4cGFuZGVkJywgJ2ZhbHNlJyApO1xuXHRcdH0gZWxzZSB7XG5cdFx0XHRidXR0b24uc2V0QXR0cmlidXRlKCAnYXJpYS1leHBhbmRlZCcsICd0cnVlJyApO1xuXHRcdH1cblx0fSApO1xuXG5cdC8vIFJlbW92ZSB0aGUgLnRvZ2dsZWQgY2xhc3MgYW5kIHNldCBhcmlhLWV4cGFuZGVkIHRvIGZhbHNlIHdoZW4gdGhlIHVzZXIgY2xpY2tzIG91dHNpZGUgdGhlIG5hdmlnYXRpb24uXG5cdGRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoICdjbGljaycsIGZ1bmN0aW9uKCBldmVudCApIHtcblx0XHRjb25zdCBpc0NsaWNrSW5zaWRlID0gc2l0ZU5hdmlnYXRpb24uY29udGFpbnMoIGV2ZW50LnRhcmdldCApO1xuXG5cdFx0aWYgKCAhIGlzQ2xpY2tJbnNpZGUgKSB7XG5cdFx0XHRzaXRlTmF2aWdhdGlvbi5jbGFzc0xpc3QucmVtb3ZlKCAndG9nZ2xlZCcgKTtcblx0XHRcdGJ1dHRvbi5zZXRBdHRyaWJ1dGUoICdhcmlhLWV4cGFuZGVkJywgJ2ZhbHNlJyApO1xuXHRcdH1cblx0fSApO1xuXG5cdC8vIEdldCBhbGwgdGhlIGxpbmsgZWxlbWVudHMgd2l0aGluIHRoZSBtZW51LlxuXHRjb25zdCBsaW5rcyA9IG1lbnUuZ2V0RWxlbWVudHNCeVRhZ05hbWUoICdhJyApO1xuXG5cdC8vIEdldCBhbGwgdGhlIGxpbmsgZWxlbWVudHMgd2l0aCBjaGlsZHJlbiB3aXRoaW4gdGhlIG1lbnUuXG5cdGNvbnN0IGxpbmtzV2l0aENoaWxkcmVuID0gbWVudS5xdWVyeVNlbGVjdG9yQWxsKCAnLm1lbnUtaXRlbS1oYXMtY2hpbGRyZW4gPiBhLCAucGFnZV9pdGVtX2hhc19jaGlsZHJlbiA+IGEnICk7XG5cblx0Ly8gVG9nZ2xlIGZvY3VzIGVhY2ggdGltZSBhIG1lbnUgbGluayBpcyBmb2N1c2VkIG9yIGJsdXJyZWQuXG5cdGZvciAoIGNvbnN0IGxpbmsgb2YgbGlua3MgKSB7XG5cdFx0bGluay5hZGRFdmVudExpc3RlbmVyKCAnZm9jdXMnLCB0b2dnbGVGb2N1cywgdHJ1ZSApO1xuXHRcdGxpbmsuYWRkRXZlbnRMaXN0ZW5lciggJ2JsdXInLCB0b2dnbGVGb2N1cywgdHJ1ZSApO1xuXHR9XG5cblx0Ly8gVG9nZ2xlIGZvY3VzIGVhY2ggdGltZSBhIG1lbnUgbGluayB3aXRoIGNoaWxkcmVuIHJlY2VpdmUgYSB0b3VjaCBldmVudC5cblx0Zm9yICggY29uc3QgbGluayBvZiBsaW5rc1dpdGhDaGlsZHJlbiApIHtcblx0XHRsaW5rLmFkZEV2ZW50TGlzdGVuZXIoJ3RvdWNoc3RhcnQnLCB0b2dnbGVGb2N1cywgZmFsc2UsIHsgcGFzc2l2ZTogdHJ1ZSB9ICk7XG5cdFx0bGluay5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIHRvZ2dsZUZvY3VzKTtcblx0fVxuXG5cdC8qKlxuXHQgKiBTZXRzIG9yIHJlbW92ZXMgLmZvY3VzIGNsYXNzIG9uIGFuIGVsZW1lbnQuXG5cdCAqL1xuXHRmdW5jdGlvbiB0b2dnbGVGb2N1cyggZXZlbnQgKSB7XG5cdFx0aWYgKCBldmVudC50eXBlID09PSAndG91Y2hzdGFydCcgfHwgZXZlbnQudHlwZSA9PT0gJ2NsaWNrJyApIHtcblx0XHRcdGNvbnN0IG1lbnVJdGVtID0gdGhpcy5wYXJlbnROb2RlO1xuXHRcdFx0ZXZlbnQucHJldmVudERlZmF1bHQoKTtcblx0XHRcdGZvciAoIGNvbnN0IGxpbmsgb2YgbWVudUl0ZW0ucGFyZW50Tm9kZS5jaGlsZHJlbiApIHtcblx0XHRcdFx0aWYgKCBtZW51SXRlbSAhPT0gbGluayApIHtcblx0XHRcdFx0XHRsaW5rLmNsYXNzTGlzdC5yZW1vdmUoICdmb2N1cycgKTtcblx0XHRcdFx0fVxuXHRcdFx0fVxuXHRcdFx0bWVudUl0ZW0uY2xhc3NMaXN0LnRvZ2dsZSggJ2ZvY3VzJyApO1xuXHRcdH1cblx0fVxufSgpICk7XG4iLCJjb25zdCBzZWFyY2hfaWNvbiA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5zaXRlLWhlYWRlciAuc2VhcmNoLXRvZ2dsZScpO1xuY29uc3Qgc2VhcmNoX2JhciA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5zaXRlLWhlYWRlciAuc2VhcmNoLWZpZWxkJyk7XG5jb25zdCBzZWFyY2hfZmllbGQgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuc2l0ZS1oZWFkZXIgLnNlYXJjaC1maWVsZCcpO1xuXG4vLyBTaG93IG9uIHRoZSBzZWFyY2ggYmFyIHdoZW4gc2VhcmNoIGljb24gaXMgY2xpY2tlZFxuc2VhcmNoX2ljb24ub25jbGljayA9ICgpID0+IHtcbiAgICBzZWFyY2hfZmllbGQuY2xhc3NMaXN0LnRvZ2dsZSgnc2VhcmNoLWFjdGl2ZScpO1xuXG4gICAgLy8gRm9jdXMgb24gdGhlIHNlYXJjaCBmaWVsZCBpZiBpdCdzIGFjdGl2ZVxuICAgIGlmIChzZWFyY2hfZmllbGQuY2xhc3NMaXN0LmNvbnRhaW5zKCdzZWFyY2gtYWN0aXZlJykpIHtcbiAgICAgICAgc2VhcmNoX2ZpZWxkLmZvY3VzKCk7XG4gICAgfVxufVxuXG4vLyBPbiBwYWdlIGxvYWQgY2xlYXIgdGhlIHNlYXJjaCBiYXJcbndpbmRvdy5vbmxvYWQgPSAoKSA9PiB7XG4gICAgc2VhcmNoX2ZpZWxkLnZhbHVlID0gJyc7XG59XG5cbmNvbnN0IGlucHV0ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLnNlYXJjaC1maWVsZCcpO1xuaWYgKGlucHV0KSB7XG4gICAgaW5wdXQuYWRkRXZlbnRMaXN0ZW5lcigna2V5dXAnLCAoKSA9PiBnYW1lU2VhcmNoKGlucHV0KSk7XG59XG5cbmNvbnN0IGJsb2NrX2lucHV0ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLndwLWJsb2NrLXNlYXJjaF9faW5wdXQnKTtcbmlmIChibG9ja19pbnB1dCkge1xuICAgIGJsb2NrX2lucHV0LmFkZEV2ZW50TGlzdGVuZXIoJ2tleXVwJywgKCkgPT4gZ2FtZVNlYXJjaChibG9ja19pbnB1dCkpO1xufVxuXG5jb25zdCBnYW1lU2VhcmNoID0gYXN5bmMgKGlucHV0KSA9PiB7XG4gICAgY29uc3QgdXJsID0gd2luZG93LmxvY2F0aW9uLm9yaWdpbjtcbiAgICBjb25zdCByZXNwb25zZSA9IGF3YWl0IGZldGNoKHVybCArICcvd3AtanNvbi93cC92Mi9zZWFyY2gvP3NlYXJjaD0nICsgaW5wdXQudmFsdWUpO1xuICAgIGNvbnN0IGRhdGEgPSBhd2FpdCByZXNwb25zZS5qc29uKCk7XG5cbiAgICBkaXNwbGF5UmVzdWx0cyhpbnB1dCwgZGF0YSk7XG59XG5cbmNvbnN0IGRpc3BsYXlSZXN1bHRzID0gKGlucHV0LCBkYXRhKSA9PiB7XG4gICAgLy8gQ3JlYXRlIC5zZWFyY2gtYXV0b2NvbXBsZXRlIGFuZCBhcHBlbmQgdG8gLnNlYXJjaC1mb3JtXG4gICAgaWYgKCFpbnB1dC5wYXJlbnRFbGVtZW50LnF1ZXJ5U2VsZWN0b3IoJy5zZWFyY2gtYXV0b2NvbXBsZXRlJykpIHtcbiAgICAgICAgbGV0IHNlYXJjaF9yZXN1bHRzID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgndWwnKTtcbiAgICAgICAgc2VhcmNoX3Jlc3VsdHMuY2xhc3NMaXN0LmFkZCgnc2VhcmNoLWF1dG9jb21wbGV0ZScpO1xuICAgICAgICBpbnB1dC5wYXJlbnRFbGVtZW50LmFwcGVuZENoaWxkKHNlYXJjaF9yZXN1bHRzKTtcblxuICAgICAgICAvLyBHZXQgdGhlIHNlYXJjaC5pbnB1dCBoZWlnaHRcbiAgICAgICAgbGV0IGlucHV0X2hlaWdodCA9IGlucHV0Lm9mZnNldEhlaWdodDtcblxuICAgICAgICAvLyBBZGQgdG9wIHByb3BlcnR5IHRvIHNlYXJjaF9yZXN1bHRzIGFuZCBoYWx2ZSBpdFxuICAgICAgICBzZWFyY2hfcmVzdWx0cy5zdHlsZS50b3AgPSBpbnB1dF9oZWlnaHQgKyAncHgnO1xuICAgIH1cblxuICAgIGNvbnN0IHNlYXJjaF9yZXN1bHRzID0gaW5wdXQucGFyZW50RWxlbWVudC5xdWVyeVNlbGVjdG9yKCcuc2VhcmNoLWF1dG9jb21wbGV0ZScpO1xuXG4gICAgLy8gQ2xlYXIgdGhlIHJlc3VsdHMgc28gd2UgZG9uJ3Qga2VlcCBhZGRpbmcgdG8gdGhlIGxpc3RcbiAgICBzZWFyY2hfcmVzdWx0cy5pbm5lckhUTUwgPSAnJztcblxuICAgIHNlYXJjaF9yZXN1bHRzLnN0eWxlLmRpc3BsYXkgPSAnYmxvY2snO1xuXG4gICAgaWYgKGRhdGEubGVuZ3RoID09PSAwKSB7XG4gICAgICAgIC8vIERpc3BsYXkgbm8gcmVzdWx0cyBmb3VuZFxuICAgICAgICBsZXQgbGlzdF9pdGVtID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgnbGknKTtcbiAgICAgICAgbGlzdF9pdGVtLmlubmVySFRNTCA9ICdObyByZXN1bHRzIGZvdW5kJztcbiAgICAgICAgc2VhcmNoX3Jlc3VsdHMuYXBwZW5kQ2hpbGQobGlzdF9pdGVtKTtcbiAgICB9IGVsc2Uge1xuICAgICAgICBmb3IgKGxldCBpID0gMDsgaSA8IGRhdGEubGVuZ3RoOyBpKyspIHtcbiAgICAgICAgICAgIGlmIChpbnB1dC52YWx1ZS5sZW5ndGggPiAwKSB7XG4gICAgICAgICAgICAgICAgLy8gSW5zZXJ0IGFuZCBkaXNwbGF5IHRoZSByZXN1bHRzXG4gICAgICAgICAgICAgICAgbGV0IGxpc3RfaXRlbSA9IGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ2xpJyk7XG4gICAgICAgICAgICAgICAgbGV0IGxpc3RfbGluayA9IGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ2EnKTtcbiAgICAgICAgICAgICAgICBsaXN0X2xpbmsuaW5uZXJIVE1MICs9IGRhdGFbaV0udGl0bGU7XG4gICAgICAgICAgICAgICAgbGlzdF9saW5rLmhyZWYgPSBkYXRhW2ldLnVybDtcbiAgICAgICAgICAgICAgICBsaXN0X2l0ZW0uYXBwZW5kQ2hpbGQobGlzdF9saW5rKTtcbiAgICAgICAgICAgICAgICBzZWFyY2hfcmVzdWx0cy5hcHBlbmRDaGlsZChsaXN0X2l0ZW0pO1xuICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICAvLyBDbGVhciBhbmQgaGlkZSB0aGUgcmVzdWx0cyBpZiBpbnB1dCBmaWVsZCBpcyBlbXB0eVxuICAgICAgICAgICAgICAgIHNlYXJjaF9yZXN1bHRzLnN0eWxlLmRpc3BsYXkgPSAnbm9uZSc7XG4gICAgICAgICAgICAgICAgc2VhcmNoX3Jlc3VsdHMuaW5uZXJIVE1MID0gJyc7XG4gICAgICAgICAgICB9XG4gICAgICAgIH1cbiAgICB9XG59Il0sIm5hbWVzIjpbInNpdGVOYXZpZ2F0aW9uIiwiYnV0dG9uIiwibWVudSIsImV2ZW50IiwibGlua3MiLCJsaW5rc1dpdGhDaGlsZHJlbiIsImxpbmsiLCJ0b2dnbGVGb2N1cyIsIm1lbnVJdGVtIiwic2VhcmNoX2ljb24iLCJzZWFyY2hfZmllbGQiLCJpbnB1dCIsImdhbWVTZWFyY2giLCJibG9ja19pbnB1dCIsInVybCIsImRhdGEiLCJkaXNwbGF5UmVzdWx0cyIsInNlYXJjaF9yZXN1bHRzIiwiaW5wdXRfaGVpZ2h0IiwibGlzdF9pdGVtIiwiaSIsImxpc3RfbGluayJdLCJtYXBwaW5ncyI6IkNBTUUsVUFBVyxDQUNaLE1BQU1BLEVBQWlCLFNBQVMsZUFBZ0IsaUJBQWlCLEVBR2pFLEdBQUssQ0FB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