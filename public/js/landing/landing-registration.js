let currentStep = 1;

const stepTabs = document.querySelectorAll('.step-tab');
const underline = document.getElementById('underline');

function updateUnderline(step) {
    const activeTab = document.querySelector(`.step-tab[data-step="${step}"]`);
    if (!activeTab) return;

    const left = activeTab.offsetLeft;
    const width = activeTab.offsetWidth;

    underline.style.width = width + 'px';
    underline.style.left = left + 'px';
}

function updateActiveTab(step) {
    stepTabs.forEach(tab => {
        if (tab.dataset.step == step) {
            tab.classList.add('text-blue-700', 'border-blue-700');
            tab.classList.remove('text-gray-600', 'border-transparent');
        } else {
            tab.classList.remove('text-blue-700', 'border-blue-700');
            tab.classList.add('text-gray-600', 'border-transparent');
        }
    });
}

function showStep(step) {
    document.querySelectorAll('.step').forEach((el) => {
        el.classList.add('hidden');
    });
    document.querySelector(`.step[data-step="${step}"]`).classList.remove('hidden');
    currentStep = step;

    updateActiveTab(step);
    updateUnderline(step);
}

function nextStep() {
    if (currentStep < 3) showStep(currentStep + 1);
}

function prevStep() {
    if (currentStep > 1) showStep(currentStep - 1);
}

function showSummary() {
    const form = document.getElementById("multiStepForm");
    const summaryDiv = document.getElementById("summary");
    const formData = new FormData(form);

    const fieldLabels = {
        name: "Nama Pendek",
        fullname_intern_candidate_profiles: "Nama Panjang",
        phone_number_intern_candidate_profiles: "Nomor HP",
        email: "Email",
        address_intern_candidate_profiles: "Alamat",
        country_intern_candidate_profiles: "Negara",
        province_intern_candidate_profiles: "Provinsi",
        regency_intern_candidate_profiles: "Kabupaten/Kota",
        district_intern_candidate_profiles: "Kecamatan",
        village_intern_candidate_profiles: "Desa/Kelurahan",
        gender_intern_candidate_profiles: "Gender",
        date_of_birth_intern_candidate_profiles: "Tanggal Lahir",
        github_intern_candidate_profiles: "GitHub",
        linkedin_intern_candidate_profiles: "LinkedIn",
        portfolio_intern_candidate_profiles: "Portfolio"
    };

    let summaryHTML = "";

    for (let [key, value] of formData.entries()) {
        // jangan tampilkan password
        if (key === "password" || key === "confirm_password") continue;

        let label = fieldLabels[key] || key;
        summaryHTML += `
      <div class="border border-gray-200 rounded-md p-4 bg-gray-50">
        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">${label}</p>
        <p class="font-medium break-words">${value || '-'}</p>
      </div>
    `;
    }

    summaryDiv.innerHTML = summaryHTML;
    showStep(3);
}

// Dropdown Berantai (Chained Select)
document.addEventListener('DOMContentLoaded', () => {
    const provinceSelect = document.getElementById('province');
    const regencySelect = document.getElementById('regency');
    const districtSelect = document.getElementById('district');
    const villageSelect = document.getElementById('village');

    if (provinceSelect) {
        provinceSelect.addEventListener('change', function () {
            const provinceName = this.value;
            fetch(`/get-regencies/${provinceName}`)
                .then(res => res.json())
                .then(data => {
                    regencySelect.innerHTML = `<option value="">-- Pilih Kabupaten/Kota --</option>`;
                    districtSelect.innerHTML = `<option value="">-- Pilih Kecamatan --</option>`;
                    villageSelect.innerHTML = `<option value="">-- Pilih Desa --</option>`;
                    data.forEach(item => {
                        regencySelect.innerHTML += `<option value="${item.name}">${item.name}</option>`;
                    });
                });
        });
    }

    if (regencySelect) {
        regencySelect.addEventListener('change', function () {
            const regencyName = this.value;
            fetch(`/get-districts/${regencyName}`)
                .then(res => res.json())
                .then(data => {
                    districtSelect.innerHTML = `<option value="">-- Pilih Kecamatan --</option>`;
                    villageSelect.innerHTML = `<option value="">-- Pilih Desa --</option>`;
                    data.forEach(item => {
                        districtSelect.innerHTML += `<option value="${item.name}">${item.name}</option>`;
                    });
                });
        });
    }

    if (districtSelect) {
        districtSelect.addEventListener('change', function () {
            const districtName = this.value;
            fetch(`/get-villages/${districtName}`)
                .then(res => res.json())
                .then(data => {
                    villageSelect.innerHTML = `<option value="">-- Pilih Desa --</option>`;
                    data.forEach(item => {
                        villageSelect.innerHTML += `<option value="${item.name}">${item.name}</option>`;
                    });
                });
        });
    }

    // Tampilkan step awal saat halaman diload
    showStep(1);
});
