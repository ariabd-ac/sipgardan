// Sidebar
const shrinkBtn = document.querySelector(".shrink-btn");
const sidebarLinks = document.querySelectorAll(".sidebar-links a");
const activeTab = document.querySelector(".active-tab");
const tooltipElements = document.querySelectorAll(".tooltip-element");
const mobileIconSidebar = document.querySelector('.icon-menu-sidebar')

const logoutBtn = document.querySelector("#logout-btn");
const logoutForm = document.querySelector("#logout-form");

let activeIndex;

switch (window.location.pathname.split("/")[1]) {
    case "parking":
        activeIndex = 1;
        break;
    case "report":
        activeIndex = 2;
        break;

    case "user":
        activeIndex = 3;
        break;

    case "report":
            activeIndex = 3;
            break;

    default:
        activeIndex = 0;
        break;
}

moveActiveTab();

shrinkBtn.addEventListener("click", () => {
    document.body.classList.toggle("shrink");
    shrinkBtn.classList.add("hovered");

    setTimeout(moveActiveTab, 400);

    setTimeout(() => {
        shrinkBtn.classList.remove("hovered");
    }, 500);
});

mobileIconSidebar.addEventListener('click',() => {
    document.body.classList.toggle("shrink");
})

function moveActiveTab() {
    let topPosition = activeIndex * 58 + 2.5;

    activeTab.style.top = `${topPosition}px`;
}

function changeLink() {
    localStorage.removeItem("hasCodeRunBefore");
    sidebarLinks.forEach((sideLink) => sideLink.classList.remove("active"));

    this.classList.add("active");

    activeIndex = this.dataset.active;

    moveActiveTab();

    switch (window.location.pathname.split("/")[1]) {
        case "parking":
            activeIndex = 1;
            break;
        case "report":
            activeIndex = 2;
            break;

        case "user":
            activeIndex = 3;
            break;
        case "admin_infractions":
            activeIndex = 4;
            break;

        default:
            activeIndex = 0;
            break;
    }

    setTimeout(() => {
        window.location.href = this.dataset.link;
        activeIndex = this.dataset.active;
    }, 500);
}

sidebarLinks.forEach((link) => link.addEventListener("click", changeLink));

function showTooltip() {
    let tooltip = this.parentNode.lastElementChild;

    let spans = tooltip.children;
    let tooltipIndex = this.dataset.tooltip;

    Array.from(spans).forEach((sp) => sp.classList.remove("show"));

    spans[tooltipIndex].classList.add("show");

    tooltip.style.top = `${
        (100 / (spans.length * 2)) * (tooltipIndex * 2 + 1)
    }%`;
}

tooltipElements.forEach((elem) =>
    elem.addEventListener("mouseover", showTooltip)
);

logoutBtn.addEventListener("click", () => {
    logoutForm.submit();
});

// Alert Close

let alertBox = document.querySelector(".alert-box");

let targetLink = null;

function showAlert() {
    if (alertBox !== null) {
        if (alertBox.dataset.alert === "show") {
            setTimeout(() => {
                alertBox.classList.remove("show");
                alertBox.classList.add("hide");
                alertBox.dataset.alert = "hide";
            }, 2000);
        }
    }
}

showAlert();

function showAlertConfirmation(target, title, description) {
    let containerAlertCorfimation = document.querySelector(".container-alert");
    let alertBoxConfirmation = document.querySelector(
        ".alert-box-confirmation"
    );

    document.querySelector("#title-alert").innerText = title;
    document.querySelector("#description-alert").innerText = description;

    targetLink = target;

    alertBoxConfirmation.classList.remove("hide");
    containerAlertCorfimation.classList.remove("hide");
}

function closeAlertConfirmation() {
    let containerAlertCorfimation = document.querySelector(".container-alert");
    let alertBoxConfirmation = document.querySelector(
        ".alert-box-confirmation"
    );
    alertBoxConfirmation.classList.add("hide");
    setTimeout(() => {
        containerAlertCorfimation.classList.add("hide");
    }, 500);
}

function okAlertConfirmation() {
    let form = document.querySelector(`#${targetLink}`);

    form.click();
    targetLink = null;
}

$("input[data-type='currency']").on({
    change: function () {
        $(this).val(formatRupiah($(this).val(), "Rp. "));
    },
    keydown: function () {
        $(this).val(formatRupiah($(this).val(), "Rp. "));
    },
    keyup: function () {
        $(this).val(formatRupiah($(this).val(), "Rp. "));
    },
    blur: function () {
        $(this).val(formatRupiah($(this).val(), "Rp. "));
    },
});

function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah :
    parseInt(angka) < 0 ? "Rp. -" + rupiah: rupiah ? "Rp. " + rupiah : "";
}
