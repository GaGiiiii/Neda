const form = document.getElementById('sortiraj-forma');
const select = document.getElementById('sortiraj-select');

const traziForm = document.getElementById('trazi-form');
const traziInput = document.getElementById('trazi-input');


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

traziForm.addEventListener('submit', (event) => {
    event.preventDefault();

    let unetiTekst = traziInput.value;

    $.ajax({
        url: 'trazi.php',
        type: 'POST',
        data: {
            trazi: true,
            tekst: unetiTekst
        },
        success: (response) => {
            console.log(response)
            if(response != ''){
                document.getElementById('knjige-container').innerHTML = response;
            }
        }
    });
});