const form = document.getElementById('sortiraj-forma');
const select = document.getElementById('sortiraj-select');


form.addEventListener('submit', (event) => {
    event.preventDefault();

    let izbor = select.options[select.selectedIndex].value;

    $.ajax({
        url: 'sortiraj.php',
        type: 'POST',
        data: {
            vrstaSorta: izbor
        },
        success: (response) => {
            console.log(response)
            document.getElementById('knjige-container').innerHTML = response;
        }
    });
});