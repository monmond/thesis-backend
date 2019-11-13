$(function () {
  console.info("monmond-table.js");
  fetch('http://localhost:8090/monmonds', {
    method: 'GET'
  }).then(function (response) {
    return response.json();
  }).then(function (response) {
    console.debug(response.data);
    let data = response.data
    if (data && data.length) {
      let dataTable = $('#dataTable')
      let table = dataTable.DataTable({
          data: data,
          columns: [{
              data: "id",
              title: "id"
            },
            {
              data: "name",
              title: "name"
            },
            {
              data: "age",
              title: "age"
            },
            {
              data: null,
              title: "options",
              className: "center",
              defaultContent: `
              <a href="index.php" class="btn btn-info btn-circle btn-sm">
                <i class="fas fa-info-circle"></i>
              </a>
              <a href="index.php" class="btn btn-danger btn-circle btn-sm">
                <i class="fas fa-trash"></i>
              </a>`
            },
          ],
          bSort: false
        });
      let footer = $('<tfoot/>').append($("#dataTable thead tr").clone());
      dataTable.append(footer);
      $('#dataTable tbody').on( 'click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            location.replace("forms.php");
        }
      });
      $('#button').click( function () {
          table.row('.selected').remove().draw(false);
      });
    }
  }).catch(function (e) {
    console.debug(e);
  });

  function mapDataSet(array) {
    return array.map(function (item) {
      return Object.values(item);
    });
  };
})