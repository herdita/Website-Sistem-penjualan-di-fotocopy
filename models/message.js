    function mess_success($data, $href) {
        swal({
                title: "Success",
                text: $data,
                icon: "success",
                timer: 3000,
            })
            .then((willsuccess) => {
                // window.location = "add.php";
                window.location.href = $href;
            });
    }

    function mess_warning($data, $href) {
        swal({
                title: "Opps!!",
                text: $data,
                icon: "warning",
                timer: 3000,
            })
            .then((willsuccess) => {
                // window.location = "add.php";
                window.location.href = $href;
            });
    }

    function mess_stok_warning($data) {
        swal({
            title: "Opps!!",
            text: $data,
            icon: "warning",
            timer: 2000,
        }).then((willsuccess) => {
            // window.location = "add.php";
            // window.location.href = $href;
        });
    }