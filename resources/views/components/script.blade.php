 {{-- Script Wizard Form --}}
 <script>
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

     // document
     //     .getElementById("enrollmentForm")
     //     .addEventListener("submit", function (e) {
     //         e.preventDefault();
     //         const studentProvince =
     //             document.getElementById("student_province").value;
     //         console.log("Nama provinsi: ", studentProvince);
     //         // Add logic to submit the form data to the server
     //     });
     showStep(1);

     document.addEventListener("DOMContentLoaded", function() {
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
             .addEventListener("change", function(event) {
                 const selectedProvinceName =
                     event.target.options[event.target.selectedIndex].text;
                 fetchRegencies(event.target.value);
                 document.getElementById("student_province").value =
                     event.target.value; // Simpan ID provinsi
                 document.getElementById("student_province_name").value =
                     selectedProvinceName; // Simpan nama provinsi
             });

         document
             .getElementById("regency")
             .addEventListener("change", function(event) {
                 const selectedRegencyId = event.target.value;
                 const selectedRegencyName =
                     event.target.options[event.target.selectedIndex].text;
                 fetchDistricts(selectedRegencyId);
                 document.getElementById("student_regency").value =
                     selectedRegencyId; // Simpan ID regency
                 document.getElementById("student_regency_name").value =
                     selectedRegencyName; // Simpan nama regency
             });

         document
             .getElementById("district")
             .addEventListener("change", function(event) {
                 const selectedDistrictId = event.target.value;
                 const selectedDistrictName =
                     event.target.options[event.target.selectedIndex].text;
                 fetchVillages(selectedDistrictId);
                 document.getElementById("student_district").value =
                     selectedDistrictId; // Simpan ID district
                 document.getElementById("student_district_name").value =
                     selectedDistrictName; // Simpan nama district
             });

         document
             .getElementById("village")
             .addEventListener("change", function(event) {
                 const selectedVillageId = event.target.value;
                 const selectedVillageName =
                     event.target.options[event.target.selectedIndex].text;
                 document.getElementById("student_village").value =
                     selectedVillageId; // Simpan ID village
                 document.getElementById("student_village_name").value =
                     selectedVillageName; // Simpan nama village
             });

         fetchProvinces();
     });

     document.addEventListener("DOMContentLoaded", function() {
         function fetchProvincesParent() {
             fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
                 .then((response) => response.json())
                 .then((data) => {
                     const provinceSelect = document.getElementById("provinceParent");
                     provinceSelect.innerHTML =
                         "<option value=''>Select Province</option>"; // Clear existing options
                     data.forEach((province) => {
                         const option = document.createElement("option");
                         option.value = province.id;
                         option.text = province.name;
                         provinceSelect.add(option);
                     });
                 })
                 .catch((error) => {
                     console.error("Error fetching provinces:", error);
                     document.getElementById("error-message").innerText =
                         "Error fetching provinces. Please check the console for more details.";
                 });
         }

         function fetchRegenciesParent(provinceParentID) {
             fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceParentID}.json`)
                 .then((response) => {
                     if (!response.ok) {
                         throw new Error("Network response was not ok");
                     }
                     return response.json();
                 })
                 .then((data) => {
                     const regencySelect = document.getElementById("regencyParent");
                     regencySelect.innerHTML =
                         "<option value=''>Select Regency</option>"; // Clear existing options
                     data.forEach((regency) => {
                         const option = document.createElement("option");
                         option.value = regency.id;
                         option.text = regency.name;
                         regencySelect.add(option);
                     });
                 })
                 .catch((error) => {
                     console.error("Error fetching regencies:", error);
                     document.getElementById("error-message").innerText =
                         "Error fetching regencies. Please check the console for more details.";
                 });
         }

         function fetchDistrictsParent(regencyParentID) {
             fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${regencyParentID}.json`)
                 .then((response) => {
                     if (!response.ok) {
                         throw new Error("Network response was not ok");
                     }
                     return response.json();
                 })
                 .then((data) => {
                     const districtSelect = document.getElementById("districtParent");
                     districtSelect.innerHTML =
                         "<option value=''>Select District</option>"; // Clear existing options
                     data.forEach((district) => {
                         const option = document.createElement("option");
                         option.value = district.id;
                         option.text = district.name;
                         districtSelect.add(option);
                     });
                 })
                 .catch((error) => {
                     console.error("Error fetching districts:", error);
                     document.getElementById("error-message").innerText =
                         "Error fetching districts. Please check the console for more details.";
                 });
         }

         function fetchVillagesParent(districtParentID) {
             fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${districtParentID}.json`)
                 .then((response) => {
                     if (!response.ok) {
                         throw new Error("Network response was not ok");
                     }
                     return response.json();
                 })
                 .then((data) => {
                     const villageSelect = document.getElementById("villageParent");
                     villageSelect.innerHTML =
                         "<option value=''>Select Village</option>"; // Clear existing options
                     data.forEach((village) => {
                         const option = document.createElement("option");
                         option.value = village.id;
                         option.text = village.name;
                         villageSelect.add(option);
                     });
                 })
                 .catch((error) => {
                     console.error("Error fetching villages:", error);
                     document.getElementById("error-message").innerText =
                         "Error fetching villages. Please check the console for more details.";
                 });
         }

         document.getElementById("provinceParent").addEventListener("change", function(event) {
             const selectedProvinceId = event.target.value;
             const selectedProvinceName = event.target.options[event.target.selectedIndex].text;
             fetchRegenciesParent(selectedProvinceId);
             document.getElementById("parent_province_name").value = selectedProvinceName;
             document.getElementById("parent_province").value =
                 selectedProvinceId; // Save the ID as well

             // Clear dependent fields
             document.getElementById("regencyParent").innerHTML =
                 "<option value=''>Select Regency</option>";
             document.getElementById("districtParent").innerHTML =
                 "<option value=''>Select District</option>";
             document.getElementById("villageParent").innerHTML =
                 "<option value=''>Select Village</option>";
         });

         document.getElementById("regencyParent").addEventListener("change", function(event) {
             const selectedRegencyId = event.target.value;
             const selectedRegencyName = event.target.options[event.target.selectedIndex].text;
             fetchDistrictsParent(selectedRegencyId);
             document.getElementById("parent_regency_name").value = selectedRegencyName;
             document.getElementById("parent_regency").value = selectedRegencyId; // Save the ID as well

             // Clear dependent fields
             document.getElementById("districtParent").innerHTML =
                 "<option value=''>Select District</option>";
             document.getElementById("villageParent").innerHTML =
                 "<option value=''>Select Village</option>";
         });

         document.getElementById("districtParent").addEventListener("change", function(event) {
             const selectedDistrictId = event.target.value;
             const selectedDistrictName = event.target.options[event.target.selectedIndex].text;
             fetchVillagesParent(selectedDistrictId);
             document.getElementById("parent_district_name").value = selectedDistrictName;
             document.getElementById("parent_district").value =
                 selectedDistrictId; // Save the ID as well

             // Clear dependent fields
             document.getElementById("villageParent").innerHTML =
                 "<option value=''>Select Village</option>";
         });

         document.getElementById("villageParent").addEventListener("change", function(event) {
             const selectedVillageId = event.target.value;
             const selectedVillageName = event.target.options[event.target.selectedIndex].text;
             document.getElementById("parent_village_name").value = selectedVillageName;
             document.getElementById("parent_village").value = selectedVillageId; // Save the ID as well
         });

         fetchProvincesParent();
     });
 </script>
 {{-- End Script Wizard Form --}}


 {{-- Script Interview Reason --}}
 <script>
     document.addEventListener('DOMContentLoaded', function() {
         const methodSelect = document.querySelector('#method');
         const onlineReason = document.querySelector('#onlineReason');

         methodSelect.addEventListener('change', function() {
             if (this.value === 'online') {
                 onlineReason.style.display = 'block';
             } else {
                 onlineReason.style.display = 'none';
             }
         });

         // Setel visibilitas form alasan sesuai dengan pilihan metode saat load halaman
         if (methodSelect.value === 'online') {
             onlineReason.style.display = 'block';
         } else {
             onlineReason.style.display = 'none';
         }
     });
 </script>
 {{-- End Script Interview Reason --}}

 {{-- Script Alamat --}}
 <script>
     document.addEventListener('DOMContentLoaded', function() {
         // Get the Residence Status select element
         var studentResidenceStatus = document.querySelector('select[name="residence_status_id"]');

         // Get the Student Address row
         var studentAddressRow = document.querySelector('#studentAddressRow');

         // Function to show or hide the Student Address row based on the Residence Status
         function updateStudentAddressVisibility() {
             if (studentResidenceStatus.value === '1') {
                 studentAddressRow.style.display = 'none';
             } else {
                 studentAddressRow.style.display = 'block';
             }
         }

         // Call the function when the page loads
         updateStudentAddressVisibility();

         // Call the function when the Residence Status select element changes
         studentResidenceStatus.addEventListener('change', updateStudentAddressVisibility);
     });
 </script>
 {{-- End Script Alamat --}}

 {{-- Script Wali --}}
 <script>
     document.addEventListener('DOMContentLoaded', function() {
         // Get the Residence Status select element
         var studentResidenceStatus = document.querySelector('select[name="residence_status_id"]');

         // Get the WaliRow div section
         var waliRow = document.getElementById("WaliRow");

         // Show WaliRow when the student selects 'Bersama Wali' option
         studentResidenceStatus.addEventListener("change", function() {
             if (this.value === "2") {
                 waliRow.style.display = "block";
             } else {
                 waliRow.style.display = "none";
             }
         });
     });
 </script>
 {{-- End script Wali --}}

 {{-- Script Penjadwalan Interview --}}
 <script>
     document.addEventListener('DOMContentLoaded', function() {
         // Get the title input element
         const titleInput = document.querySelector('#title');

         // Add an event listener for input event
         titleInput.addEventListener('input', function() {
             // Set the value of the title input to the desired format
             this.value = `Penjadwalan Interview PPDB - ${document.querySelector('#fullName').value}`;
         });

         // Trigger the input event initially to set the value on page load
         titleInput.dispatchEvent(new Event('input'));

         // Add a class to disable editing the input field
         titleInput.classList.add('form-control-disabled');

         // Prevent default behavior when clicking on the input field
         titleInput.addEventListener('click', function(event) {
             event.preventDefault();
         });
     });
 </script>
 {{-- EndScript Penjadwalan Interview --}}

 {{-- Script Hidden Btn Next --}}
 <script>
     document.addEventListener('DOMContentLoaded', function() {
         const steps = [1, 2, 3, 4]; // List of step numbers

         function validateForm(step) {
             const inputs = document.querySelectorAll(`#step${step} input, #step${step} select`);
             const nextButton = document.getElementById(`nextButtonStep${step}`);
             let isValid = true;

             // Check if all inputs in the step are filled
             inputs.forEach(input => {
                 if (input.hasAttribute('required') && !input.value) {
                     isValid = false;
                 }
             });

             // Special handling for step 2
             if (step === 2) {
                 const residenceStatus = document.getElementById('userStay').value;
                 const studentAddressRow = document.getElementById('studentAddressRow');
                 const WaliRow = document.getElementById('WaliRow');

                 if (residenceStatus !== '1') {
                     studentAddressRow.style.display = 'block';
                     WaliRow.style.display = 'block';
                 } else {
                     studentAddressRow.style.display = 'none';
                     WaliRow.style.display = 'none';
                 }
             }

             if (step === 3) {
                 const previousStep = step - 1; // Step sebelumnya
                 const previousResidenceStatus = document.getElementById(`userStayStep${previousStep}`)
                     .value; // Mendapatkan status tinggal dari step sebelumnya
                 const residenceStatus = document.getElementById('userStay').value;
                 const studentAddressRow = document.getElementById('studentAddressRow');
                 const WaliRow = document.getElementById('WaliRow');

                 // Menampilkan atau menyembunyikan row berdasarkan status tinggal pada step 3
                 if (previousResidenceStatus !== '1' && residenceStatus !== '1') {
                     studentAddressRow.style.display = 'block';
                     WaliRow.style.display = 'block';
                 } else {
                     studentAddressRow.style.display = 'none';
                     WaliRow.style.display = 'none';
                 }
             }

             // Display or hide the next button based on validity
             if (isValid) {
                 nextButton.style.display = 'block';
             } else {
                 nextButton.style.display = 'none';
             }
         }

         steps.forEach(step => {
             const inputs = document.querySelectorAll(`#step${step} input, #step${step} select`);
             inputs.forEach(input => {
                 input.addEventListener('input', () => validateForm(step));
                 input.addEventListener('change', () => validateForm(step));
             });

             // Initial validation check for each step
             validateForm(step);
         });
     });
 </script>


 {{-- End Script Hidden Btn Next --}}

 {{-- Script Telp --}}
 <script>
     // Memilih input nomor telepon Ayah
     const dadTelInput = document.getElementById('dadphoneNumber');
     const momTelInput = document.getElementById('momphoneNumber');
     const waliTelInput = document.getElementById('waliphoneNumber');

     // Menambahkan event listener untuk memeriksa setiap kali nilai input berubah
     dadTelInput.addEventListener('input', function(event) {
         // Menghapus karakter non-angka dari nilai input
         this.value = this.value.replace(/\D/g, '');
     });
     momTelInput.addEventListener('input', function(event) {
         // Menghapus karakter non-angka dari nilai input
         this.value = this.value.replace(/\D/g, '');
     });
     waliTelInput.addEventListener('input', function(event) {
         // Menghapus karakter non-angka dari nilai input
         this.value = this.value.replace(/\D/g, '');
     });
 </script>
