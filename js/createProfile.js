let addressBox = document.getElementById('profileAddress');

fetch('./js/city.json')
    .then(response => response.json())
    .then((data) => {
        data.forEach(element => {
            let option = document.createElement('option');
            option.innerHTML = element.engName + " - " + element.name;
            option.value = element.engName;
            addressBox.appendChild(option);
        });        
    }
)