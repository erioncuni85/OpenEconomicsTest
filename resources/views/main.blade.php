<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <style>
        .custom-row:hover {
            background-color: rgb(228, 225, 225);
        }

        .bg-gray {
            background-color: rgb(228, 225, 225);
        }
    </style>
</head>

<body>
    <header>
        <div class="row justify-content-center align-items-center g-2 bg-dark p-2">
            <div class="col-auto text-light">OpenEconomics – API Excercise</div>
        </div>
    </header>
    <main class="container">
        <div class="row g-2 p-2">
            <div class="col-lg-4 text-center p-2">
                <h3 class="m-0">Regions</h3>
                <div class="col-md-6 m-2 mx-auto" id="regions">
                </div>
                <div class="d-flex justify-content-center align-items-center d-none" id="spinner-regions">
                    <div class="spinner-border text-primary spinner-border-sm" role="status">
                        <span class="visually-hidden"></span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 text-center p-2">
                <h3 class="m-0">Species</h3>
                <div class="col-md-6 m-2 mx-auto" id="species">
                </div>
                <div class="d-flex justify-content-center align-items-center d-none" id="spinner-species">
                    <div class="spinner-border text-primary spinner-border-sm" role="status">
                        <span class="visually-hidden"></span>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

    <script>
        const regions = document.getElementById('regions');
        const species = document.getElementById('species');

        loadRegions();

        function loadRegions()
        {
            document.getElementById('spinner-regions').classList.remove('d-none')
            regions.classList.add('opacity-25')

            fetch('/api/regions')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network error!');
                    }

                    return response.json();
                })
                .then (data => {
                    document.getElementById('spinner-regions').classList.add('d-none')
                    regions.classList.remove('opacity-25')
                    regions.innerHTML = ''
                    regions.classList.add('border')
                    data = data.data.results
                    data.forEach(element => {
                        regions.innerHTML += `<p class='m-0 p-1 border-bottom custom-row' style='cursor: pointer;' onclick='loadSpecies("${element.identifier}", this)'>${element.name}</p>`
                    });
                })
                .catch(error => {
                    console.error('Error: ', error)
                })
        }

        function loadSpecies(identifier, element)
        {
            var e = regions.querySelector('.bg-gray')
            if (e) {
                e.classList.remove('bg-gray')
            }
            element.classList.add('bg-gray')
            regions.querySelector('.bg-gray')
            document.getElementById('spinner-species').classList.remove('d-none')
            regions.style.pointerEvents = 'none'
            species.classList.remove('border')
            species.innerHTML = ''
            regions.classList.add('opacity-25')
            fetch(`/api/species/${identifier}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network error!');
                    }

                    return response.json();
                })
                .then (data => {
                    document.getElementById('spinner-species').classList.add('d-none')
                    regions.style.pointerEvents = ''
                    species.classList.add('border')
                    species.classList.remove('opacity-25')
                    regions.classList.remove('opacity-25')
                    data = data.data.result
                    for (let i=0; i<data.length; i++) {
                        species.innerHTML += `<p class='m-0 p-1 border-bottom' style='cursor: pointer;'>${data[i].scientific_name}</p>`
                        if (i>=10) {
                            break;
                        }
                    }
                })
                .catch(error => {
                    console.error('Error: ', error)
                })
        }
    </script>
</body>

</html>
