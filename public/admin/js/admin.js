const pages = ["Dashboard", "Menu", "Transaksi"];
const icon = ["fa-solid fa-table-columns", "fa-solid fa-cake-candles", "fa-solid fa-book-bookmark"];

$(document).ready(function () {
    if (window.location.search.includes("status-menu-updated")) {
        setPage(pages[1]);
        setTitle(pages[1]);
        setHeader(pages[1]);
        renderSideNavPage();
        setSideNavPage(pages[1]);
    } else if (window.location.search.includes("status-transaksi-updated")) {
        setPage(pages[2]);
        setTitle(pages[2]);
        setHeader(pages[2]);
        renderSideNavPage();
        setSideNavPage(pages[2]);
    } else {
        setPage(pages[0]);
        setTitle(pages[0]);
        setHeader(pages[0]);
        renderSideNavPage();
    }
    setImagePreview();
    setUpdateStatusProduct();
});

function setUpdateStatusProduct() {
    $(".status-form select").off("change");
    $(".status-form select").on("change", function () {
        var form = $(this).closest("form");

        if (form.data("type") === "menu") {

            var id = form.data("id");
            var status = $(this).val() === "true";

            $.ajax({
                url: `/myadmin/${id}/set-bs`,
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    status: status,
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: "Success!",
                            text: "Status updated successfully",
                            icon: "success",
                            confirmButtonText: "OK",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href =
                                    window.location.pathname +
                                    "?status-menu-updated=true";
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Failed",
                            text: response.message,
                            icon: "error",
                            confirmButtonText: "OK",
                        });
                    }
                },
                error: function (xhr, status, error) {
                    alert("Error: " + error);
                },
            })
        } else if (form.data("type") === "transaksi") {
            let nama = form.data("name");
            let created_at = form.data("created_at");
            let status = $(this).val();

            $.ajax({
                url: `/transactions/status-update/${nama}/${created_at}/${status}`,
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    _method: "PATCH",
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: "Success!",
                            text: "Status updated successfully",
                            icon: "success",
                            confirmButtonText: "OK",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = window.location.pathname + "?status-transaksi-updated=true";
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Failed",
                            text: response.message,
                            icon: "error",
                            confirmButtonText: "OK",
                        });
                    }
                },
                error: function (xhr, status, error) {
                    alert("Error: " + error);
                },
            });
        }
    });
}

$(document).ready(function () {
    setUpdateStatusProduct();
});


function confirmDelete(id) {
    $("#deleteProduct" + id).preventDefault();

    Swal.fire({
        title: "Anda yakin?",
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika pengguna mengonfirmasi, kirimkan form
            $("#deleteProduct" + id).submit();
        }
    });

    return false; // Mengembalikan false untuk mencegah pengiriman form langsung
}

function renderSideNavPage() {
    for (let i = 0; i < pages.length; i++) {
        console.log(icon[i]);
        let liElement = $("<li>")
            .addClass("mt-0.5 w-full nav-page")
            .attr("data-page", pages[i])
            .on("click", function () {
                setPage(pages[i]);
                setSideNavPage(pages[i]);
                setTitle(pages[i]);
            });

        let buttonElement = $("<a>")
            .addClass(
                " text-sm ease-nav-brand my-0 cursor-pointer mx-2 w-max flex items-center whitespace-nowrap px-4 transition-colors no-underline"
            )
            .attr("type", "button");

        let divElement = $("<div>").addClass(
            "mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
        );

        let iElement = $("<i>").addClass(
            `relative top-0 text-sm leading-normal  ni ${icon[i]}`
        );

        let spanElement = $("<span>")
            .addClass("ml-1 duration-300 opacity-100 pointer-events-none ease text no-underline	text-black")
            .text(pages[i]);

        if (pages[i] === pages[0]) {
            buttonElement.addClass(
                "py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80"
            );
            iElement.addClass("text-orange-500");
        } else {
            buttonElement.addClass("dark:text-white dark:opacity-80 py-2.7");
            iElement.addClass("text-blue-500");
        }

        divElement.append(iElement);
        buttonElement.append(divElement);
        buttonElement.append(spanElement);
        liElement.append(buttonElement);
        $("#sidenav-menu").append(liElement);
    }
}

function setPage(page) {
    $(".page").each(function () {
        $(this).fadeOut(0);
        if ($(this).attr("id") === page.toLowerCase()) {
            $(this).fadeIn(100);
        }
    });
}

function setTitle(page) {
    $("title").text(`Manika Brownies | ${page}`);
}

function setHeader(page) {
    $("#current-page").text(page);
}

function setSideNavPage(page) {
    $(".nav-page").each(function () {
        $(this)
            .find("a")
            .removeClass(
                "py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80"
            )
            .addClass("dark:text-white dark:opacity-80 py-2.7");
        $(this)
            .find("i")
            .removeClass("text-orange-500")
            .addClass("text-blue-500");
        if ($(this).data("page") === page) {
            $(this)
                .find("a")
                .removeClass("dark:text-white dark:opacity-80 py-2.7")
                .addClass(
                    "py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80"
                );
            $(this)
                .find("i")
                .removeClass("text-blue-500")
                .addClass("text-orange-500");
        }
    });
}

function setImagePreview() {
    $("#gambar_kue").change(function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $("#imagePreview").attr("src", e.target.result).show();
            };
            reader.readAsDataURL(file);
        }
    });
}
