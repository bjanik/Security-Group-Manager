let expanded = false;

function showCheckboxes() {
  var checkboxes = document.querySelector("#checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}

const fathersList = document.querySelector("#fathersList");
const fathersListSelection = document.querySelector("#fatherSelection");
const securityGroupType = document.querySelector("#sgType");

securityGroupType.addEventListener("change", (e) => {
  if (e.target.value === "Son" && fathersList.style.display === "") {
    fathersList.style.display = "block";
    fathersListSelection.setAttribute("required", "");
    fathersListSelection.selectedIndex = 0;
  }
  if (e.target.value !== "Son" && fathersList.style.display === "block") {
    fathersList.style.display = "";
    fathersListSelection.removeAttribute("required");
    fathersListSelection.selectedIndex = -1;
  }

});