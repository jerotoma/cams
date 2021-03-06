const ModalPlugin = {
    install(Vue) {
      Vue.mixin({
        data() {
          return {

          };
        },
        methods: {
            loadPageInAModal(url, title = 'View', iconClass = 'fa-eye') {
                var modaldis = '<div class="modal fade" data-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                modaldis+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                modaldis+= '<div class="modal-content">';
                modaldis+= '<div class="modal-header bg-indigo">';
                modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center">'
                + '<i class="fa ' + iconClass + ' ' + ' font-blue-sharp"></i>' + ' ' + title + '</span>'
                modaldis+= '</div>';
                modaldis+= '<div class="modal-body">';
                modaldis+= ' </div>';
                modaldis+= '</div>';
                modaldis+= '</div>';

                $('body').css('overflow-y','scroll');
                $("body").append(modaldis);
                $("#myModal").modal("show");
                $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                $(".modal-body").load(url);
                $("#myModal").on('hidden.bs.modal', function(){
                    $("#myModal").remove();
                })
            },
            // Confirmation dialog
            deleteRecord(url) {
                bootbox.confirm("Are you sure you want to delete this record?", function(result) {
                    if(result){
                        axios({
                            method: 'DELETE',
                            url: url,
                        }).then(function (response) {
                            location.reload();
                        });
                    }
                });
            },
             // Confirmation dialog
             authorizeRecord(url) {
                bootbox.confirm("Are you sure you want to athorize this record?", function(result) {
                    if(result){
                        axios({
                            method: 'POST',
                            url: url,
                        }).then((response) => {
                            if (response) {
                               location.reload();
                            }
                        });
                    }
                });
            },
            // Confirmation dialog
            downloadRecord(url) {
                bootbox.confirm("Are you sure you want to athorize this record?", function(result) {
                    if(result){
                        axios({
                            method: 'POST',
                            url: url,
                        }).then((response) => {
                            location.reload();
                        });
                    }
                });
            },
        },
      });
      Object.defineProperty(Vue.prototype, "$modal", {
        get() {
          return this.$root;
        }
      });
    }
  };
  export default ModalPlugin;

