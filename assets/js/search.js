const search_icon = document.querySelector('.site-header .search-submit');
const search_bar = document.querySelector('.site-header .search-field');
const search_field = document.querySelector('.site-header .search-field');

// Hide results if clicked outside of element
document.body.onclick = (evt) => {
    if (evt.target.classList[0] !== 'search-field') {
        let search_results = document.querySelectorAll('.autocomplete-search-results');

        for (let i = 0; i < search_results.length; i++) {
            search_results[i].style.display = 'none';
        }
    }
};

const input = document.querySelector('.search-field');
if (input) {
    input.addEventListener('keyup', () => gameSearch(input));
}

const gameSearch = async (input) => {
    const url = window.location.origin;
    const response = await fetch(url + '/wp-json/wp/v2/search/?search=' + input.value);
    const data = await response.json();

    displayResults(input, data);
}

const displayResults = (input, data) => {
    // Create .search-autocomplete and append to .search-form
    if (!input.parentElement.querySelector('.search-autocomplete')) {
        let search_results = document.createElement('ul');
        search_results.classList.add('search-autocomplete');
        input.parentElement.appendChild(search_results);

        // Get the search.input height
        let input_height = input.offsetHeight;

        // Add top property to search_results and halve it
        search_results.style.top = input_height + 'px';
    }

    const search_results = input.parentElement.querySelector('.search-autocomplete');

    // Clear the results so we don't keep adding to the list
    search_results.innerHTML = '';

    for (let i = 0; i < data.length; i++) {
        if (input.value.length > 0) {
            // Insert and display the results
            search_results.style.display = 'block';
            let list_item = document.createElement('li');
            let list_link = document.createElement('a');
            list_link.innerHTML += data[i].title;
            list_link.href = data[i].url;
            list_item.appendChild(list_link);
            search_results.appendChild(list_item);
        } else {
            // Clear and hide the results if input field is empty
            search_results.style.display = 'none';
            search_results.innerHTML = '';
        }

        // Clear and hide the results if input field not focused
        input.onblur = () => {
            search_results.style.display = 'none';
            search_results.innerHTML = '';
        }
    }
}