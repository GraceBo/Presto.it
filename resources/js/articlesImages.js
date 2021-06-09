$(function () {
    if ($("#drophere").length > 0) {
        let csrfToken = $('input[name="_token"]').attr("value");
        let uniqueSecret = $('input[name="uniqueSecret"]').attr("value");

        let myDropzone = new Dropzone("#drophere", {
            url: "/articoli/caricamento/immagini",
            params: {
                _token: csrfToken,
                uniqueSecret: uniqueSecret,
            },
            addRemoveLinks: true,
            init: function () {
                $.ajax({
                    type: "GET",
                    url: "/articolo/vecchie/immagini",
                    data: {
                        uniqueSecret: uniqueSecret,
                    },
                    dataType: "json",
                }).done(function (data) {
                    $.each(data, function (key, value) {
                        let file = {
                            serverId: value.id,
                        };
                        myDropzone.options.addedfile.call(myDropzone, file);
                        myDropzone.options.thumbnail.call(
                            myDropzone,
                            file,
                            value.src
                        );
                    });
                });
            },
        });

        myDropzone.on("success", function (file, response) {
            file.serverId = response.id;
        });

        myDropzone.on("removedfile", function (file) {
            $.ajax({
                type: "DELETE",
                url: "/articolo/rimuovi/immagini",
                data: {
                    _token: csrfToken,
                    id: file.serverId,
                    uniqueSecret: uniqueSecret,
                },
                dataType: "json",
            });
        });
    }
});
