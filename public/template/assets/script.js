let currentStep = 1;

function showStep(stepNumber) {
    document
        .querySelectorAll(".step")
        .forEach((step) => (step.style.display = "none"));
    document.getElementById(`step${stepNumber}`).style.display = "block";
    currentStep = stepNumber;
}

function nextStep(nextStepNumber) {
    if (validateStep(currentStep)) {
        showStep(nextStepNumber);
    }
}

function prevStep(prevStepNumber) {
    showStep(prevStepNumber);
}

function validateStep(step) {
    // Add validation logic here if needed
    return true;
}

// document.getElementById('enrollmentForm').addEventListener('submit', function (e) {
//     e.preventDefault();
//     // Add logic to submit the form data to the server
//     console.log('Form submitted successfully!');
// });
showStep(1);

document.addEventListener("DOMContentLoaded", function () {
    function fetchProvinces() {
        fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
            .then((response) => response.json())
            .then((data) => {
                const provinceSelect = document.getElementById("province");
                data.forEach((province) => {
                    const option = document.createElement("option");
                    option.value = province.id;
                    option.text = province.name;
                    provinceSelect.add(option);
                });
            })
            .catch((error) => {
                console.error("Error fetching provinces:", error);
                // Display error message
                document.getElementById("error-message").innerText =
                    "Error fetching provinces. Please check the console for more details.";
            });
    }

    function fetchRegencies(provinceId) {
        fetch(
            `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`
        )
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then((data) => {
                const regencySelect = document.getElementById("regency");
                regencySelect.innerHTML = "";
                data.forEach((regency) => {
                    const option = document.createElement("option");
                    option.value = regency.id;
                    option.text = regency.name;
                    regencySelect.add(option);
                });
            })
            .catch((error) => {
                console.error("Error fetching regencies:", error);
                // Display error message
                document.getElementById("error-message").innerText =
                    "Error fetching regencies. Please check the console for more details.";
            });
    }

    function fetchDistricts(regencyId) {
        fetch(
            `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${regencyId}.json`
        )
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then((data) => {
                const districtSelect = document.getElementById("district");
                districtSelect.innerHTML = "";
                data.forEach((district) => {
                    const option = document.createElement("option");
                    option.value = district.id;
                    option.text = district.name;
                    districtSelect.add(option);
                });
            })
            .catch((error) => {
                console.error("Error fetching districts:", error);
                // Display error message
                document.getElementById("error-message").innerText =
                    "Error fetching districts. Please check the console for more details.";
            });
    }

    function fetchVillages(districtId) {
        fetch(
            `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${districtId}.json`
        )
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then((data) => {
                const villageSelect = document.getElementById("village");
                villageSelect.innerHTML = "";
                data.forEach((village) => {
                    const option = document.createElement("option");
                    option.value = village.id;
                    option.text = village.name;
                    villageSelect.add(option);
                });
            })
            .catch((error) => {
                console.error("Error fetching villages:", error);
                // Display error message
                document.getElementById("error-message").innerText =
                    "Error fetching villages. Please check the console for more details.";
            });
    }

    document
        .getElementById("province")
        .addEventListener("change", function (event) {
            const selectedProvinceId = event.target.value;
            fetchRegencies(selectedProvinceId);
            document.getElementById("student_province").value =
                selectedProvince;
        });

    document
        .getElementById("regency")
        .addEventListener("change", function (event) {
            const selectedRegencyId = event.target.value;
            fetchDistricts(selectedRegencyId);
        });

    document
        .getElementById("district")
        .addEventListener("change", function (event) {
            const selectedDistrictId = event.target.value;
            fetchVillages(selectedDistrictId);
        });

    fetchProvinces();
});

document.addEventListener("DOMContentLoaded", function () {
    function fetchProvincesParent() {
        fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
            .then((response) => response.json())
            .then((data) => {
                const provinceSelect =
                    document.getElementById("provinceParent");
                data.forEach((province) => {
                    const option = document.createElement("option");
                    option.value = province.id;
                    option.text = province.name;
                    provinceSelect.add(option);
                });
            })
            .catch((error) => {
                console.error("Error fetching provinces:", error);
                // Display error message
                document.getElementById("error-message").innerText =
                    "Error fetching provinces. Please check the console for more details.";
            });
    }

    function fetchRegenciesParent(provinceParentID) {
        fetch(
            `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceParentID}.json`
        )
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then((data) => {
                const regencySelect = document.getElementById("regencyParent");
                regencySelect.innerHTML = "";
                data.forEach((regency) => {
                    const option = document.createElement("option");
                    option.value = regency.id;
                    option.text = regency.name;
                    regencySelect.add(option);
                });
            })
            .catch((error) => {
                console.error("Error fetching regencies:", error);
                // Display error message
                document.getElementById("error-message").innerText =
                    "Error fetching regencies. Please check the console for more details.";
            });
    }

    function fetchDistrictsParent(regencyParentID) {
        fetch(
            `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${regencyParentID}.json`
        )
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then((data) => {
                const districtSelect =
                    document.getElementById("districtParent");
                districtSelect.innerHTML = "";
                data.forEach((district) => {
                    const option = document.createElement("option");
                    option.value = district.id;
                    option.text = district.name;
                    districtSelect.add(option);
                });
            })
            .catch((error) => {
                console.error("Error fetching districts:", error);
                // Display error message
                document.getElementById("error-message").innerText =
                    "Error fetching districts. Please check the console for more details.";
            });
    }

    function fetchVillagesParent(districtParentID) {
        fetch(
            `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${districtParentID}.json`
        )
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then((data) => {
                const villageSelect = document.getElementById("villageParent");
                villageSelect.innerHTML = "";
                data.forEach((village) => {
                    const option = document.createElement("option");
                    option.value = village.id;
                    option.text = village.name;
                    villageSelect.add(option);
                });
            })
            .catch((error) => {
                console.error("Error fetching villages:", error);
                // Display error message
                document.getElementById("error-message").innerText =
                    "Error fetching villages. Please check the console for more details.";
            });
    }

    document
        .getElementById("provinceParent")
        .addEventListener("change", function (event) {
            const selectedProvinceId = event.target.value;
            fetchRegenciesParent(selectedProvinceId);
        });

    document
        .getElementById("regencyParent")
        .addEventListener("change", function (event) {
            const selectedRegencyId = event.target.value;
            fetchDistrictsParent(selectedRegencyId);
        });

    document
        .getElementById("districtParent")
        .addEventListener("change", function (event) {
            const selectedDistrictId = event.target.value;
            fetchVillagesParent(selectedDistrictId);
        });

    fetchProvincesParent();
});
