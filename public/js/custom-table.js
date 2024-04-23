const regions = document.getElementById('regions');
const species = document.getElementById('species');

loadRegions();

function loadRegions() {
    document.getElementById('spinner-regions').classList.remove('d-none')
    regions.classList.add('opacity-25')

    fetch('/api/regions')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network error!');
            }

            return response.json();
        })
        .then(data => {
            document.getElementById('spinner-regions').classList.add('d-none')
            regions.classList.remove('opacity-25')
            regions.innerHTML = ''
            regions.classList.add('border')
            data = data.data.results
            data.forEach(element => {
                regions.innerHTML += `<p class='m-0 p-1 border-bottom custom-row' style='cursor: pointer;' onclick='loadSpecies("${element.identifier}", this)' data-identifier="${element.identifier}">${element.name}</p>`
            });
        })
        .catch(error => {
            console.error('Error: ', error)
        })
}

function loadSpecies(identifier, element, className = '') {
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

    api = `/api/species/${identifier}`
    if (className != '') api += `?class=${className}`

    fetch(api)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network error!');
            }

            return response.json();
        })
        .then(data => {
            document.getElementById('spinner-species').classList.add('d-none')
            regions.style.pointerEvents = ''
            regions.classList.remove('opacity-25')
            data = data.data
            i = 0
            data.forEach(function (specie) {
                if (i >= 50) {
                    return;
                }
                species.innerHTML += `
                            <tr class="table-primary">
                                <td>${specie.taxonid}</td>
                                <td>${specie.main_common_name ?? '<p class="text-danger m-0">!</p>'}</td>
                                <td>${specie.scientific_name}</td>
                                <td>${specie.category}</td>
                                <td>${specie.phylum_name}</td>
                                <td>${specie.kingdom_name}</td>
                                <td>${specie.family_name}</td>
                                <td>${specie.class_name}</td>
                                <td>${specie.order_name}</td>
                                <td>${specie.taxonomic_authority}</td>
                                <td>${specie.genus_name}</td>
                            </tr>
                        `
                i += 1
            })
        })
        .catch(error => {
            console.error('Error: ', error)
        })
}

function loadSpeciesByClass(className, element) {
    var e = regions.querySelector('.bg-gray')

    if (!e) {
        alert('Error');
        element.value = "";
        return;
    }

    loadSpecies(e.dataset.identifier, e, className)
}