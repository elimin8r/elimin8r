const search_icon = document.querySelector('.site-header .search-toggle');
const search_bar = document.querySelector('.site-header .search-field');
const search_field = document.querySelector('.site-header .search-field');

// Show on the search bar when search icon is clicked
search_icon.onclick = () => {
    search_field.classList.toggle('search-active');
    search_field.focus();
}

// On page load clear the search bar
window.onload = () => {
    search_field.value = '';
}

// Hide results if clicked outside of element
document.body.onclick = (evt) => {
    if (evt.target.classList[0] !== 'search-field') {
        search_field.value = '';
        
        const search_results = input.parentElement.querySelector('.search-autocomplete');

        if (search_results) {
            // search_results.style.display = 'none';
            // search_results.innerHTML = '';
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

    search_results.style.display = 'block';

    if (data.length === 0) {
        // Display no results found
        let list_item = document.createElement('li');
        list_item.innerHTML = 'No results found';
        search_results.appendChild(list_item);
    } else {
        for (let i = 0; i < data.length; i++) {
            if (input.value.length > 0) {
                // Insert and display the results
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
        }
    }
}