var expanded = false;

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
console.log(securityGroupType);

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

// function showSecurityGroupsFatherType(cloudProvider) {
//   var xmlhttp = new XMLHttpRequest();
//     xmlhttp.onreadystatechange = function() {
//       if (this.readyState == 4 && this.status == 200) {
//         fatherSecurityGroupSelection = document.querySelector("#fatherList");
//         document.getElementById("").innerHTML = this.responseText;
//       }
//     };
//     xmlhttp.open("GET", "security_group/get_father_security_groups.php?cloud_provider=" + cloudProvider, true);
//     xmlhttp.send();
// }
