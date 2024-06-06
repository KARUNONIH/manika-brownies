const pages = ["Home", "Menu", "About"];
let currentNumberGroupMenu = 1;
let currenMenuCategory = "all"

$(document).ready(function () {
    renderNavPage();
    setPage(pages[0]);
    setTitle(pages[0]);
    setActionButton();
    callJson("product");
    callJson("category");
    getProductByCategory(currenMenuCategory);
    setLocalStorage();
    checkInputDataUser();
});

function renderListCategory(data) {
    let output = "";
    output += '<li class="cursor-pointer text-[#F7C815] capitalize">all</li>';
    $.each(data, function (index, value) {
      output += '<li class="cursor-pointer capitalize">' + value.namaKategori + "</li>";
    });
    $("#list-category").html(output);

    $("#list-category li").each(function () {
      if ($(this).text() == currenMenuCategory) {
        $(this).addClass("text-[#F7C815]");
      } else {
        $(this).removeClass("text-[#F7C815]");
      }
    });

    $("#list-category li").click(function () {
      $("#list-category li").removeClass("text-[#F7C815]");
      $(this).addClass("text-[#F7C815]");
      if (currenMenuCategory != $(this).text()) {
        getProductByCategory($(this).text());
      }
      currenMenuCategory = $(this).text();
    });
}

function setImageCarousel(data) {
    let highlightImages = $(".higlight-image");
    let imageSmall = $(".higlight-image-small");
    let imageText = $(".higlight-image-text");

    highlightImages.each(function (index, item) {
        let dataIndex = index % data.length;
        $(item).attr("src", data[dataIndex].image);
    });

    imageSmall.each(function (index, item) {
        let dataIndex = index % data.length;
        $(item).attr("src", data[dataIndex].image);
    });

    imageText.each(function (index, item) {
        let dataIndex = index % data.length;
        $(item).text(data[dataIndex].name);
    });
}


function renderNavPage() {
    for (let i = 0; i < pages.length; i++) {
        let liElement = $("<li>")
            .attr("data-page", pages[i])
            .addClass(
                "group relative w-full rounded border-2 border-[#583E26] px-1 py-0.5 text-center md:border-none md:border-0 md:p-0 nav-page "
            )
            .on("click", function () {
                setPage(pages[i]);
                setNavPage(pages[i]);
                setTitle(pages[i]);
            });

        let aElement = $("<a>")
            .attr("href", "#")
            .addClass("text-xs md:text-sm lg:text-base font-bold capitalized")
            .text(pages[i]);

        let divElement = $("<div>").addClass(
            "absolute -bottom-1 h-1 bg-[#F7C815] duration-300 md:group-hover:w-full hidden md:block"
        );

        if (pages[i] === pages[0]) {
            liElement.addClass(
                "bg-[#583E26] md:bg-white text-white md:text-black"
            );
            divElement.addClass("w-full");
        } else {
            divElement.addClass("w-0");
        }

        liElement.append(aElement).append(divElement);
        $("#nav-menu").append(liElement);
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

function setNavPage(page) {
    if ($(window).innerWidth() <= 768) {
        $(".nav-page").each(function () {
            $(this)
                .removeClass("bg-[#583E26] text-white")
                .addClass("bg-white text-black");
            if ($(this).data("page") === page) {
                $(this)
                    .addClass("bg-[#583E26] text-white")
                    .removeClass("bg-white text-black");
            }
        });
    } else {
        $(".nav-page").each(function () {
            $(this).find("div").removeClass("w-full").addClass("w-0");
            if ($(this).data("page") === page) {
                $(this).find("div").removeClass("w-0").addClass("w-full");
            }
        });
    }
}

function setTitle(page) {
    $("title").text(`Manika Brownies | ${page}`);
}

function setActionButton() {
    let navIsOpen = false;

    $(".btn-page-menu").each(function () {
        $(this).off("click");
        $(this).on("click", function () {
            setPage(pages[1]);
            setNavPage(pages[1]);
        });
    });

    $("#btn-navbar")
        .off("click")
        .on("click", function () {
            if (navIsOpen === false) {
                $("#icon-navbar").removeClass("fa-bars").addClass("fa-xmark");
                $("#navbar-default").slideDown(200);
            } else {
                $("#icon-navbar").removeClass("fa-xmark").addClass("fa-bars");
                $("#navbar-default").slideUp(200);
            }

            navIsOpen = !navIsOpen;
        });

    $(".btn-indicator").each(function () {
        $(this).off("click");
        $(this).on("click", function () {
            changeGroupMenu($(this).data("indicator-no"));
        });
    });

    let noGroupMenu;
    $("#btn-previous-group-menu").off("click");
    $("#btn-next-group-menu").off("click");

    $("#btn-previous-group-menu").on("click", function () {
        noGroupMenu = currentGroupMenu() - 1;
        console.log("prev", noGroupMenu);
        setCurrentGroupMenu(noGroupMenu);
    });
    $("#btn-next-group-menu").on("click", function () {
        noGroupMenu = currentGroupMenu() + 1;
        console.log("next", noGroupMenu);
        setCurrentGroupMenu(noGroupMenu);
    });

    $(".btn-show-cart").each(function () {
        $(this).off("click");
        $(this).on("click", function () {
            $("#cart").slideToggle(100);
        });
    });

    $("#btn-close-cart").each(function () {
        $(this).off("click");
        $(this).on("click", function () {
            $("#cart").slideUp(100);
        });
    });

    $(".btn-add-to-cart").each(function () {
        $(this).off("click");
        $(this).on("click", function () {
            console.log("clicl");
            callJson("product", $(this).data("id-product"), function (product) {
                addToCart(product);
                console.log(product);
            });
        });
    });

    $("#btn-show-modal")
        .off("click")
        .on("click", function () {
            $("#default-modal").fadeIn(0, function () {
                $(this).css("display", "flex");
            });
        });

    $("#btn-close-modal")
        .off("click")
        .on("click", function () {
            $("#default-modal").fadeOut(100);
        });
}

function callJson(name, id, callback) {
    switch (name) {
        case "product":
            getJson("product").then(function (data) {
                if (id) {
                    let product = data.filter((item) => item.id === id);
                    callback(product);
                } else {
                    renderProduct(data);
                    setImageCarousel(data);
                }
            });
            break;
        case "category":
            getJson("category").then(function (data) {
                renderListCategory(data);
            });
            break;
        default:
            console.log(`${name} tidak ditemukan`);
    }
}

function getJson(type) {
    return new Promise((resolve, reject) => {
        switch (type) {
            case "product":
                $.ajax({
                    url: "/dataProduct",
                    method: "GET",
                    dataType: "json",
                    success: function (data) {
                        resolve(data.products);
                    },
                    error: function (error) {
                        reject(error);
                    },
                });
                break;
                case "category":
                    $.ajax({
                        url: "/dataProduct",
                        method: "GET",
                        dataType: "json",
                        success: function (data) {
                            resolve(data.categories);
                        },
                        error: function (error) {
                            reject(error);
                        },
                    });
                    break;
            default:
                reject(`file json ${type} tidak ditemukan`);
        }
    });
}

function createProductElement(item) {
    let productElement = $("<div>").addClass(
        "p-2 bg-white shadow-md shadow-gray-300 rounded-[14px] border-t-[2px] border-gray-100 flex flex-col justify-between"
    );

    let imgElement = $("<img>")
        .attr("src", item.image)
        .attr("alt", item.name)
        .addClass("rounded-md w-full aspect-video");

    let titleElement = $("<p>")
        .addClass("capitalize font-bold text-center text-base mt-2")
        .text(item.name);

    let descriptionElement = $("<p>")
        .addClass("text-xs")
        .text(item.description);

    let sectionElement = $("<section>").addClass(
        "flex items-center justify-between mt-3"
    );

    let priceElement = $("<p>")
        .addClass("text-sm font-medium")
        .text(
            item.price
                .toLocaleString("id-ID", {
                    style: "currency",
                    currency: "IDR",
                })
                .replace("IDR", "")
                .trim()
        );

    let cartButtonElement = $("<button>")
        .addClass(
            "px-1 border-2 border-[#583e26] rounded-full text-xs hover:text-white md:hover:bg-[#583e26] duration-200 cursor-pointer btn-add-to-cart"
        )
        .text("add to cart")
        .attr("data-id-product", item.id)
        .attr("type", "button");

    let divInfoProduct = $("<div>").addClass("");

    sectionElement.append(priceElement, cartButtonElement);
    divInfoProduct.append(imgElement, titleElement, descriptionElement);
    productElement.append(divInfoProduct, sectionElement);

    return productElement;
}

function renderProduct(product) {
    product.forEach((item) => {
        if (item.status === true) {
            console.log("best");
            $("#wrapper-best-seller-product").append(
                createProductElement(item)
            );
        }
    });
}

function getProductByCategory(category) {
    let currentCategory = category;
    $("#wrapper-product").html("");

    getJson("product").then(function (data) {
        let product = data;
        let groupsize;
        let groupNo = 0;

        if (currentCategory !== "all") {
            product = data.filter((item) => item.category === currentCategory);
        }
        if ($(window).innerWidth() < 750) {
            groupsize = 4;
        } else if ($(window).innerWidth() > 750) {
            groupsize = 8;
        }

        for (let i = 0; i < product.length; i += groupsize) {
            let group = product.slice(i, i + groupsize);
            groupNo += 1;
            let section = $("<section>")
                .addClass(
                    "grid grid-cols-1 gap-2 md:gap-3 lg:gap-5 min-[470px]:grid-cols-2 min-[750px]:grid-cols-4 min-[1200px]:grid-cols-4 menu-group"
                )
                .attr("data-group-no", groupNo);
            group.forEach(function (value) {
                section.append(createProductElement(value));
            });

            $("#wrapper-product").append(section);
        }

        let maxGroupMenu = Math.ceil(product.length / groupsize);
        showProduct(1);
        setIndicatorGropMenu(1, maxGroupMenu);
        setActionButton();
    });
}

function showProduct(n) {
    $(".menu-group").each(function () {
        if ($(this).data("group-no") === n) {
            $(this).fadeIn(100);
            currentNumberGroupMenu = $(this).data("group-no");
        } else {
            $(this).fadeOut(0);
        }
    });
}

function setIndicatorGropMenu(current, maxGroupMenu) {
    $("#wrapper-indicator-group-menu").html("");
    console.log(maxGroupMenu);
    if (maxGroupMenu > 1) {
        $("#wrapper-all-indicator-group-menu").fadeIn(100);
        for (let i = 1; i <= maxGroupMenu; i++) {
            let button = $("<button>")
                .addClass("h-3 w-3 rounded-full btn-indicator")
                .attr("data-indicator-no", i);

            if (i === current) {
                button.addClass("bg-[#583e26]");
            } else {
                button.addClass("bg-[#a78b71]");
            }
            $("#wrapper-indicator-group-menu").append(button);
        }
        setActionButton();
    } else {
        $("#wrapper-all-indicator-group-menu").fadeOut(100);
    }
}

function changeGroupMenu(current) {
    showProduct(current);

    $(".btn-indicator").each(function () {
        $(this).removeClass("bg-[#583e26]").addClass("bg-[#a78b71]");
        if ($(this).data("indicator-no") === current) {
            $(this).removeClass("bg-[#a78b71]").addClass("bg-[#583e26]");
        }
    });
}

function currentGroupMenu() {
    return currentNumberGroupMenu;
}

function setCurrentGroupMenu(index) {
    let totalGroupMenu = $(".menu-group").length;
    console.log("index", index);

    if (index === 0) {
        changeGroupMenu(totalGroupMenu);
        console.log("pertama", totalGroupMenu);
    } else if (index === totalGroupMenu + 1) {
        changeGroupMenu(1);
        console.log("terakhir", 1);
    } else {
        changeGroupMenu(index);
        console.log("tengah", index);
    }
}

function renderProductInCart(data) {
    let section = $("<section>").addClass(
        "flex items-center justify-between gap-4 rounded-[6px] bg-white py-1 pl-1 pr-2 shadow mr-2"
    );
    let img = $("<img>")
        .addClass("aspect-video w-20 rounded-sm")
        .attr("src", data.img);
    let nameElement = $("<p>")
        .addClass(
            "w-24 overflow-hidden truncate text-ellipsis text-left text-xs md:text-sm font-semibold uppercase"
        )
        .text(data.name);
    let priceElement = $("<p>")
        .addClass("text-xs")
        .text(
            Number(data.totalPrice).toLocaleString("id-ID", {
                style: "currency",
                currency: "IDR",
            })
        );
    let div = $("<div>").addClass("flex items-center gap-1 min-[1250px]:gap-2");
    let buttonPlus = $("<button>")
        .addClass(
            "flex h-4 w-4 items-center justify-center rounded-full bg-black text-xs text-white min-[1250px]:h-4 min-[1250px]:w-4 min-[1250px]:text-xs"
        )
        .attr("data-id", data.id)
        .html(`<i class="fa-solid fa-plus"></i>`)
        .off("click")
        .on("click", function () {
            changeQuantityProduct("plus", data.id);
        });
    let buttonMinus = $("<button>")
        .addClass(
            "flex h-4 w-4 items-center justify-center rounded-full bg-black text-xs text-white min-[1250px]:h-4 min-[1250px]:w-4 min-[1250px]:text-xs"
        )
        .attr("data-id", data.id)
        .html(`<i class="fa-solid fa-minus"></i>`)
        .off("click")
        .on("click", function () {
            changeQuantityProduct("minus", data.id);
        });
    let qty = $("<input>")
        .addClass(
            " h-6 w-6 rounded-full border-2 p-2 border-slate-200 text-xs min-[1250px]:h-6 min-[1250px]:w-9 min-[1250px]:text-xs input-product-cart"
        )
        .val(data.quantity)
        .attr("data-id", data.id)
        .attr("type", "number")
        .off("click")
        .on("change", function () {
            changeQuantityProduct("customInput", data.id);
        });
    let iconDelete = $("<div>")
        .html(`<i class="fa-regular fa-trash-can cursor-pointer"></i>`)
        .off("click")
        .on("click", function () {
            deleteProductInCart(data.id);
        });
    div.append(buttonMinus, qty, buttonPlus);
    section.append(img, nameElement, priceElement, div, iconDelete);

    return section;
}

function setCart() {
    let productInCart = getlocalStorage("product");

    if (productInCart.length === 0) {
        $("#product-in-cart").html("");
        let noItem = $("<section>")
            .addClass(
                "rounded-[6px] bg-white p-1 shadow mr-2 text-center font-semibold text-capitalize text-sm italic"
            )
            .text("Anda belum memasukkan menu apapun");
        $("#product-in-cart").append(noItem);
    } else if (productInCart.length > 0) {
        $("#product-in-cart").html("");
        let normal = $("<div>").addClass("flex flex-col gap-2");
        productInCart.forEach(function (item) {
            normal.append(renderProductInCart(item));
            $("#product-in-cart").append(normal);
        });
    }
    setInfoCart(productInCart);
    setInfoDataUser();
    checkOrder();
}

function setInfoDataUser() {
    let dataUSer = getlocalStorage("dataUser");

    $("#nama-penerima").text(dataUSer.nama !== "" ? dataUSer.nama : "-");
    $("#telepon-penerima").text(
        dataUSer.telepon !== "" ? dataUSer.kode + dataUSer.telepon : "-"
    );
    $("#alamat-penerima").text(dataUSer.alamat !== "" ? dataUSer.alamat : "-");
    $("#namaPenerima").val(dataUSer.nama);
    $("#teleponPenerima").val(dataUSer.telepon);
    $("#alamatPenerima").val(dataUSer.alamat);
}

function setInfoCart(product) {
    let totalItem = 0;
    let totalHarga = 0;
    let totalMenu = product.length;

    product.forEach(function (item) {
        totalItem += item.quantity;
        totalHarga += item.totalPrice;
    });

    $(".cart-indicator").each(function () {
        if (product.length !== 0) {
            $(this).text(totalMenu);
            $(this).removeClass("hidden").addClass("flex");
        } else {
            $(this).removeClass("flex").addClass("hidden");
        }
    });
    $("#total-menu").text(totalMenu);
    $("#total-item").text(`${totalItem} item`);
    $("#total-harga").text(
        Number(totalHarga).toLocaleString("id-ID", {
            style: "currency",
            currency: "IDR",
        })
    );
}

function setLocalStorage() {
    if (localStorage.getItem("product") === null) {
        localStorage.setItem("product", "[]");
    }

    if (localStorage.getItem("dataUser") === null) {
        let userData = { nama: "", telepon: "", alamat: "", kode: "+62" };
        localStorage.setItem("dataUser", JSON.stringify(userData));
    }

    setCart();
}

function getlocalStorage(key) {
    switch (key) {
        case "product":
            return JSON.parse(localStorage.getItem("product"));
        case "dataUser":
            return JSON.parse(localStorage.getItem("dataUser"));
        default:
            console.log(`key ${key} tidak ada di local storage`);
            break;
    }
}

function postLocalStorage(key, value) {
    switch (key) {
        case "product":
            localStorage.setItem("product", JSON.stringify(value));
            break;
        case "dataUser":
            localStorage.setItem("dataUser", JSON.stringify(value));
            break;
        default:
            console.log(`key ${key} tidak ada di local storage`);
            break;
    }
}

function checkProductisExist(productId) {
    let cartProduct = getlocalStorage("product");
    let filteredProduct = cartProduct.filter((item) => item.id === productId);
    return filteredProduct.length > 0;
}

function addToCart(product) {
    let cartProduct = getlocalStorage("product");

    if (checkProductisExist(product[0].id)) {
        cartProduct = cartProduct.map((item) => {
            if (item.id === product[0].id) {
                return {
                    ...item,
                    quantity: item.quantity + 1,
                    totalPrice: item.quantity * item.price,
                };
            }
            return item;
        });
    } else {
        cartProduct.push({
            id: product[0].id,
            img: product[0].image,
            name: product[0].name,
            price: product[0].price,
            quantity: 1,
            totalPrice: 1 * product[0].price,
        });
    }

    postLocalStorage("product", cartProduct);
    setCart();
    swal.fire({
        html: `<p class='text-sm'>Berhasil menambahkan ${product[0].name} ke dalam keranjang</p>`,
        icon: "success",
    });
}

function deleteProductInCart(idProduct, type) {
    console.log("delete cart cui");
    let cartProduct = getlocalStorage("product");
    let removeProduct = cartProduct.filter(
        (product) => product.id !== idProduct
    );
    let selectedProduct = cartProduct.filter(
        (product) => product.id === idProduct
    );

    if (type === "direct") {

        postLocalStorage("product", removeProduct);
        setCart();
    } else {
        console.log("delete tombol");
        swal.fire({
            html: `<p class='text-sm'>Menghapus ${selectedProduct[0].name} ?</p>`,
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Hapus",
            cancelButtonText: "Batalkan",
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                postLocalStorage("product", removeProduct);
                setCart();
            }
        });
    }
}

function updateProductInCart(idProduct, product) {
    let cartProduct = getlocalStorage("product");
    let index = cartProduct.findIndex((product) => product.id === idProduct);

    cartProduct[index] = product;
    postLocalStorage("product", cartProduct);
    setCart();
}

function changeQuantityProduct(type, idProduct) {
    let cartProduct = getlocalStorage("product");
    let product = cartProduct.filter((product) => product.id === idProduct);
    let quantityProduct = product[0].quantity;

    switch (type) {
        case "plus":
            quantityProduct += 1;
            console.log("plus");
            break;
        case "minus":
            if (quantityProduct === 1) {
                Swal.fire({
                    title: `Jumlah produk ${product[0].name} menjadi 0`,
                    text: `akan dihapus jika dilanjutkan`,
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Ya, lanjutkan",
                    cancelButtonText: "Batalkan",
                    reverseButtons: true,
                }).then((Result) => {
                    if (Result.isConfirmed) {
                        deleteProductInCart(idProduct, "direct");
                    } else {
                        quantityProduct = product[0].quantity;
                    }
                });
            } else {
                quantityProduct -= 1;
            }
            break;
        case "customInput":
            $(".input-product-cart").each(function () {
                if ($(this).data("id") === idProduct) {
                    quantityProduct = parseInt($(this).val());
                }
            });
            break;
    }

    product[0].quantity = quantityProduct;
    product[0].totalPrice = product[0].quantity * product[0].price;
    updateProductInCart(idProduct, product[0]);
}

function checkInputDataUser() {
    $("#namaPenerima")
        .off("input")
        .on("input", function () {
            let dataUser = getlocalStorage("dataUser");
            dataUser.nama = $(this).val();
            postLocalStorage("dataUser", dataUser);
            checkDataUser();
        });

    $("#negaraTeleponPenerima")
        .off("input")
        .on("input", function () {
            let dataUser = getlocalStorage("dataUser");
            dataUser.kode = "+" + $(this).val();
            postLocalStorage("dataUser", dataUser);
            checkDataUser();
        });

    $("#teleponPenerima")
        .off("input")
        .on("input", function () {
            let dataUser = getlocalStorage("dataUser");
            dataUser.telepon = $(this).val();
            postLocalStorage("dataUser", dataUser);
            checkDataUser();
        });

    $("#alamatPenerima")
        .off("input")
        .on("input", function () {
            let dataUser = getlocalStorage("dataUser");
            dataUser.alamat = $(this).val();
            postLocalStorage("dataUser", dataUser);
            checkDataUser();
        });
}

function checkDataUser() {
    let userData = getlocalStorage("dataUser");
    if (
        userData.nama !== "" &&
        userData.telepon !== "" &&
        userData.alamat !== "" &&
        userData.kode !== "+"
    ) {
        $("#submit-data-user")
            .removeClass("bg-gray-600")
            .addClass("bg-green-600")
            .off("click")
            .on("click", function () {
                setDataUser(
                    userData.nama,
                    userData.telepon,
                    userData.alamat,
                    userData.kode
                );
            });
        $("#btn-close-modal")
            .off("click")
            .on("click", function () {
                $("#default-modal").fadeOut(100);
            });
        checkOrder();
    } else {
        $("#submit-data-user")
            .removeClass("bg-green-600")
            .addClass("bg-gray-600")
            .off("click");
        $("#btn-close-modal")
            .off("click")
            .on("click", function () {
                setDefaultDataUser();
                $("#default-modal").fadeOut(100);
            });
    }
}

function setDefaultDataUser() {
    postLocalStorage("dataUser", {
        nama: "",
        telepon: "",
        alamat: "",
        kode: "+62",
    });
    setInfoDataUser();
}

function setDataUser(nama, telepon, alamat, kode) {
    $("#default-modal").fadeOut(100);
    let dataUser = { nama: nama, telepon: telepon, alamat: alamat, kode: kode };
    postLocalStorage("dataUser", dataUser);
    setInfoDataUser();
}

function checkOrder() {
    let productInCart = getlocalStorage("product");
    let dataUser = getlocalStorage("dataUser");

    if (
        productInCart.length > 0 &&
        dataUser.nama !== "" &&
        dataUser.telepon !== "" &&
        dataUser.alamat !== "" &&
        dataUser.kode !== "+"
    ) {
        $("#btn-checkout")
            .removeClass("bg-gray-600 md:hover:bg-gray-700")
            .addClass("bg-[#9c4a1a] md:hover:bg-[#583e26]")
            .off("click")
            .on("click", function () {
                makeOrder();
            });
    } else {
        $("#btn-checkout")
            .removeClass("bg-[#9c4a1a] md:hover:bg-[#583e26]")
            .addClass("bg-gray-600 md:hover:bg-gray-700")
            .off("click");
    }
}

function makeOrder() {
    let message = makeMessageForOrder();
    let encodedMessage = encodeURIComponent(message);
    let teleponPenjual = "62895326112374";
    let waLink = `https://wa.me/${teleponPenjual}?text=${encodedMessage}`;

    window.open(waLink, "_blank");
}

function makeMessageForOrder() {
    let productInCart = getlocalStorage("product");
    let dataUser = getlocalStorage("dataUser");

    let message =
        `Halo Manika Brownies,\n\n` +
        `Saya ingin memesan produk brownies dari toko Anda. Berikut adalah detail pesanan saya:\n\n` +
        `*Data Diri:*\n` +
        `Nama: ${dataUser.nama}\n` +
        `Nomor Telepon: ${dataUser.kode}${dataUser.telepon}\n` +
        `Alamat: ${dataUser.alamat}\n\n` +
        `*Pesanan:*\n`;

    let totalHarga = 0;
    productInCart.forEach((item, index) => {
        message += `${index + 1}. ${item.name} - Harga satuan: ${Number(
            item.price
        ).toLocaleString("id-ID", {
            style: "currency",
            currency: "IDR",
        })} - Jumlah: ${item.quantity} \n`;
        totalHarga += item.totalPrice;
    });

    message +=
        `\nTotal Harga: ${Number(totalHarga).toLocaleString("id-ID", {
            style: "currency",
            currency: "IDR",
        })}\n\n` + `Terima kasih. Saya tunggu konfirmasi lebih lanjut.`;

    return message;
}
