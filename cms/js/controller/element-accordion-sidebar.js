$(function () {
  let url = location.href;
  let file = url.substring(url.lastIndexOf('/') + 1);
  let navItem;
  let navLink;
  let collapse;
  let collapseItem;
  switch (file) {
    case "index.php":
      navItem = $("#navItemIndex");
      break;
    case "buttons.php":
    case "cards.php":
      navItem = $("#navItemTwo");
      navLink = $("#navLinkTwo");
      collapse = $("#collapseTwo");
      break;
    case "utilities-color.php":
    case "utilities-border.php":
    case "utilities-animation.php":
    case "utilities-other.php":
      navItem = $("#navItemUtilities");
      navLink = $("#navLinkUtilities");
      collapse = $("#collapseUtilities");
      break;
    case "login.php":
    case "register.php":
    case "forgot-password.php":
    case "404.php":
    case "blank.php":
      navItem = $("#navItemPages");
      navLink = $("#navLinkPages");
      collapse = $("#collapsePages");
      break;
    case "charts.php":
      navItem = $("#navItemCharts");
      break;
    case "tables.php":
      navItem = $("#navItemTables");
      break;
    case "monmond-tables.php":
      navItem = $("#navItemMonmondTables");
      break;
    default:
      break;
  }
  switch (file) {
    case "index.php":
      break;
    case "buttons.php":
      collapseItem = $("#collapseItemButtons");
      break;
    case "cards.php":
      collapseItem = $("#collapseItemCards");
      break;
    case "utilities-color.php":
      collapseItem = $("#collapseItemColor");
      break;
    case "utilities-border.php":
      collapseItem = $("#collapseItemBorder");
      break;
    case "utilities-animation.php":
      collapseItem = $("#collapseItemAnimation");
      break;
    case "utilities-other.php":
      collapseItem = $("#collapseItemOther");
      break;
    case "login.php":
    case "register.php":
    case "forgot-password.php":
      break;
    case "404.php":
      collapseItem = $("#collapseItem404");
      break;
    case "blank.php":
      collapseItem = $("#collapseItemBlank");
      break;
    case "charts.php": 
    case "tables.php": 
    case "monmond-tables.php": 
      break;
    default:
      break;
  }
  if (navItem) {
    navItem.addClass('active');
  }
  if (navLink) {
    navLink.removeClass('collapsed');
  }
  if (collapse) {
    collapse.addClass('show');
  }
  if (collapseItem) {
    collapseItem.addClass('active');
  }
})