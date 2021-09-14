window.addEventListener("touchstart", {
    passive: true
});
var site_url = 'https://otoparcasan.com/';
var domain_name = 'otoparcasan.com';

function loader() {
    $.blockUI.defaults.baseZ = 1500;
    $.blockUI({
        css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff',
        },
        message: 'Yükleniyor...'
    });
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function filterDoit() {
    loader();
    $('#category-filter').submit();
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function responseMessage(msg) {
    $('.success-box').fadeIn(200);
    $('.success-box div.text-message').html("<span>" + msg + "</span>");
}

/* quantity */
function increaseValue(artis = 1, id = '') {
    var value = parseInt($('[name="number_' + id + '"]').val(), 10);
    value = isNaN(value) ? artis : value;
    value = value + artis;
    $('[name="number_' + id + '"]').val(value);
}

function decreaseValue(artis = 1, id = '') {
    var value = parseInt($('[name="number_' + id + '"]').val(), 10);
    if (value > artis) {
        value = isNaN(value) ? artis : value;
        value < 1 ? value = 1 : '';
        value = value - artis;
        $('[name="number_' + id + '"]').val(value);
    }
}

function addToCartListingFull(id, cari) {
    loader();
    var count = $('[name="number_' + id + '"]').val();
    addToCart(id, cari, count);
}

function addToCart(id, cari, count) {
    $.ajax({
        url: site_url + 'Ajax/addToCart/',
        method: 'POST',
        dataType: 'JSON',
        data: {
            id: id,
            count: count,
            cari: cari
        },
        success: function (result) {
            if (result.status == 1) {
                if (addToCartStorage(result.product)) {
                    $.unblockUI();
                    Swal.fire({
                        type: 'success',
                        confirmButtonText: 'Tamam',
                        title: 'Ürün Sepete Eklendi',
                        text: 'Seçtiğiniz Ürün Başarılı Bir Şekilde Sepete Eklendi',
                        animation: false,
                    });
                } else {
                    $.unblockUI();
                    Swal.fire({
                        type: 'error',
                        confirmButtonText: 'Tamam',
                        title: 'Hata !',
                        html: 'Üzgünüz Teknik Bir Sorun İle Karşı Karşıyayız',
                        animation: false,
                    });
                }
            } else {
                $.unblockUI();
                Swal.fire({
                    type: 'error',
                    confirmButtonText: 'Tamam',
                    title: 'Hata !',
                    html: result.error,
                    animation: false,
                });
            }
        },
        error: function (result) {
            $.unblockUI();
            Swal.fire({
                type: 'error',
                confirmButtonText: 'Tamam',
                title: 'Hata !',
                html: 'Üzgünüz Teknik Bir Sorun İle Karşı Karşıyayız',
                animation: false,
                
            });
        }
    });
}

function currencyFormatDE(num) {
    return (num.toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
}

function updateToCart() {
    var echo = '';
    var sum = 0;
    var localProducts = localStorage.getItem('ops-products');
    if (localProducts) {
        localProducts = JSON.parse(localProducts);
        if (localProducts.count == 0) {
            $('#cartNum').text(0);
            $('.SepetDolu').css('display', 'none');
            $('.SepetBos').css('display', 'block');
        } else {
            $('#cartNum').text(localProducts.count);
            localProducts.products = localProducts.products.reverse();
            $.each(localProducts.products, function (key, val) {
                sum = sum + (val.price * val.count);
                echo += '<li class="Item">\
                <div class="Left">\
                <div class="Img">\
                <img width="76" src="'+site_url+'assets/products/'+val.kod3+'.png'+'" alt="">\
                </div>\
                <div class="productInfo">\
                <a href="' + site_url + val.url + '" class="ProductName">' + val.name + '</a>\
                <span class="Features">Adet : ' + val.count + '</span>\
                <span class="Features">Ürün Kodu : ' + val.stok_kodu + '</span>\
                </div>\
                </div>\
                <div class="Right">\
                <div class="Price">' + currencyFormatDE(val.price * val.count) + ' TL</div>\
                </div>\
                <div class="DeleteItem" onclick="cartProductDel(' + key + ')">\
                <i class="fa fa-times" aria-hidden="true"></i>\
                </div>\
                </li>';
            });
            $('.ChartProducts').html(echo);
            $('.TotalPriceCur').html(currencyFormatDE(sum) + ' TL');
            $('.SepetDolu').css('display', 'block');
            $('.SepetBos').css('display', 'none');
        }
    } else {
        $('#cartNum').text(0);
        $('.SepetDolu').css('display', 'none');
        $('.SepetBos').css('display', 'block');
    }
}

function cartProductDel(key) {
    var localProducts = localStorage.getItem('ops-products');
    if (localProducts) {
        localProducts = JSON.parse(localProducts);
        localProducts.count = localProducts.count - 1;
        console.log(localProducts.products);
        localProducts.products.splice(key, 1);
        console.log(localProducts.products);
        localStorage.setItem('ops-products', JSON.stringify(localProducts));
        updateToCart();
    }
}

function cartProductDelCartPage(key) {
    Swal.fire({
        title: 'Silme İşlemi',
        text: "Ürünü sepetinizden silmek istediğinize emin misiniz ?",
        type: 'error',
        showCancelButton: true,
        confirmButtonColor: '#DD631F',
        cancelButtonColor: '#1889CB',
        confirmButtonText: 'Evet Sil',
        cancelButtonText: 'Vazgeç'
    }).then((result) => {
        if (result.value) {
            loader();
            var localProducts = localStorage.getItem('ops-products');
            if (localProducts) {
                localProducts = JSON.parse(localProducts);
                localProducts.count = localProducts.count - 1;
                console.log(localProducts.products);
                localProducts.products.splice(key, 1);
                console.log(localProducts.products);
                localStorage.setItem('ops-products', JSON.stringify(localProducts));
                updateToCart();
                location.reload();
            }
        }
    });
}

function updateCart() {
    data = [];
    $.each($('.cartProductItem'), function (key, val) {
        var temp = {};
        temp.key = $('> [name=key]', val).val();
        temp.val = $('.quantity-area input', val).val();
        data.push(temp);
    });
    var localProducts = JSON.parse(localStorage.getItem('ops-products'));
    $.each(localProducts.products, function (key, val) {
        $.each(data, function (key2, val2) {
            if (key == val2.key) {
                localProducts.products[key].count = Number(val2.val);
            }
        });
    });
    localStorage.setItem('ops-products', JSON.stringify(localProducts));
}

function removeAllToCart() {
    Swal.fire({
        title: 'Silme İşlemi',
        text: "Sepetinizdeki bütün ürünleri silmek istediğinize emin misiniz ?",
        type: 'error',
        showCancelButton: true,
        confirmButtonColor: '#DD631F',
        cancelButtonColor: '#1889CB',
        confirmButtonText: 'Evet Sil',
        cancelButtonText: 'Vazgeç'
    }).then((result) => {
        if (result.value) {
            loader();
            localStorage.removeItem('ops-products');
            location.reload();
        }
    });
}

function addToCartStorage(product) {
    var localProducts = localStorage.getItem('ops-products');
    if (localProducts) {
        localProducts = JSON.parse(localProducts);
        if (localProducts.count == 0) {
            var localProducts = {};
            localProducts.products = [];
            localProducts.count = 1;
            product.count = Number(product.count);
            product.price = Number(product.price);
            product.oldPrice = Number(product.oldPrice);
            localProducts.products.push(product);
            localStorage.setItem('ops-products', JSON.stringify(localProducts));
        } else {
            localProducts.count = localProducts.count + 1;
            product.count = Number(product.count);
            product.price = Number(product.price);
            product.oldPrice = Number(product.oldPrice);
            localProducts.products.push(product);
            localStorage.setItem('ops-products', JSON.stringify(localProducts));
        }
    } else {
        var localProducts = {};
        localProducts.products = [];
        localProducts.count = 1;
        product.count = Number(product.count);
        product.price = Number(product.price);
        product.oldPrice = Number(product.oldPrice);
        localProducts.products.push(product);
        localStorage.setItem('ops-products', JSON.stringify(localProducts));
    }
    updateToCart();
    return true;
}

function goToAdress() {
    loader();
    var localProducts = localStorage.getItem('ops-products');
    var order_note = $('#order_note').val();
    var giftCheck_id = $('#giftCheckId').val();
    var check = {};
    check.hizmet = $('#hizmet').prop('checked');
    check.iptal = $('#iptal').prop('checked');
    if (check.hizmet == false) {
        $.unblockUI();
        Swal.fire({
            type: 'error',
            title: 'Hata !',
            confirmButtonText: 'Tamam',
            html: 'Hizmet sözleşmesini onaylamadan siparişinizi tamamlayamazsınız.',
            animation: false,
            
        });
    }else if (check.iptal == false) {
        $.unblockUI();
        Swal.fire({
            type: 'error',
            title: 'Hata !',
            confirmButtonText: 'Tamam',
            html: 'İptal, İade Koşulları ve Gizlilik sözleşmesini onaylamadan siparişinizi tamamlayamazsınız.',
            animation: false,
            
        });
    }else{
        if (localProducts) {
            localProducts = JSON.parse(localProducts);
            if (localProducts.count != 0) {
                localProducts.cargo = cargo;
                var i = 0;
                $.each(localProducts.products, function (key, val) {
                    if (val.status == 0) {
                        i++;
                    }
                })
                if (i > 0) {
                    $.unblockUI();
                    Swal.fire({
                        type: 'error',
                        title: 'Hata !',
                        confirmButtonText: 'Tamam',
                        html: 'İşaretli Ürünün Stoğunda veya fiyatında bir problem var Lütfen İlerlemeden önce ürünü silin',
                        animation: false,
                        
                    });
                } else {
                    $.ajax({
                        url: site_url + 'Ajax/goToAdress/',
                        method: 'POST',
                        dataType: 'JSON',
                        data: {
                            data: localProducts,
                            order_note : order_note,
                            giftCheck : giftCheck_id
                        },
                        success: function (result) {
                            if (result.status == false) {
                                $.unblockUI();
                                if (result.errCode == 2) {
                                    userAlert();
                                } else if (result.errCode == 3) {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Hata !',
                                        confirmButtonText: 'Tamam',
                                        html: result.message,
                                        animation: false,
                                        
                                    });
                                }
                            } else if (result.status == 1) {
                                window.location = site_url + 'sepet/adres';
                            }
                        },
                        error: function (result) {
                            $.unblockUI();
                            Swal.fire({
                                type: 'error',
                                title: 'Hata !',
                                confirmButtonText: 'Tamam',
                                html: 'Üzgünüz Teknik Bir Sorun İle Karşı Karşıyayız',
                                animation: false,
                                
                            });
                        }
                    });
                }
            } else {
                $.unblockUI();
            }
        } else {
            $.unblockUI();
        }
    }
}

function userAlert() {
    Swal.fire({
        html: "<center>Sipariş Vermek İçin Giriş Yapmalısınız</center>",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#dd631f',
        cancelButtonColor: '#188acc',
        confirmButtonText: 'Giriş Yap',
        cancelButtonText: "Kayıt Ol"
    }).then((result) => {
        if (result.value) {
            window.location = site_url + 'giris-yap?redirect=' + window.location.href;
        } else if (result.dismiss == 'cancel') {
            window.location = site_url + 'kayit-ol?redirect=' + window.location.href;
        }
    });
}

function addGaraggeFromSelected() {
    var data = JSON.parse($.cookie("selectedCar"));
    loader();
    $.ajax({
        url: site_url + 'Service/addGarrage',
        method: 'POST',
        data: data,
        success: function (result) {
            if (result == 'Err') {
                $.unblockUI();
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    confirmButtonText: 'Tamam',
                    html: '<p style="text-align:center;">Bu araç garajınızda zaten var.</p>',
                    animation: false,
                    
                });
            } else if (result == 'Usr') {
                $.unblockUI();
                userAlert();
            } else {
                $.cookie("selectedCar", JSON.stringify(data), {
                    expires: 1,
                    path: '/',
                    domain: domain_name,
                    secure: true
                });
                window.location.href = site_url + "hesabim/garajim";
            }
        },
        error: function (result) {
            $.unblockUI();
            Swal.fire({
                type: 'error',
                title: 'Hata !',
                confirmButtonText: 'Tamam',
                html: '<p style="text-align:center;">Üzgünüz Teknik Bir Hata Oluştu</p>',
                animation: false,
                
            });
        }
    });
}

function GetURLParameter(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) {
            return sParameterName[1];
        }
    }
}

function listenAjaxRequest(callback) {
    var originalOpenFunction = XMLHttpRequest.prototype.open;

    XMLHttpRequest.prototype.open = function (method, url) {
        originalOpenFunction.apply(this, arguments);

        this.addEventListener('readystatechange', function () {
            if (this.readyState === 4 && this.status === 200) {
                if (typeof callback === 'function') {
                    try {
                        callback(url, this.responseText, method);
                    } catch (error) {
                        console.log('Something is crashed, Event:' + error);
                    }
                }
            }
        });
    };
};

function removeSelectedCar() {
    loader();
    $.removeCookie('selectedCar', {
        path: '/',
        domain: domain_name
    });
    location.reload();
}

function getCart() {
    var total = 0;
    loader();
    var localProducts = localStorage.getItem('ops-products');
    if (localProducts) {
        localProducts = JSON.parse(localProducts);
        if (localProducts.count != 0) {
            $('.sub').text('(sepetinizde ' + localProducts.count + ' adet ürün bulunmaktadır)');
            $.ajax({
                url: site_url + 'Ajax/getToCart/',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    data: localProducts
                },
                success: function (result) {
                    if (result.status == 1) {
                        var dataTxt = '';

                        $.each(result.data, function (key, val) {
                            result.data[key].count = Number(val.count);
                            result.data[key].oldPrice = Number(val.oldPrice);
                            result.data[key].price = Number(val.price);
                        });
                        var newLocalProducts = {};
                        newLocalProducts.products = result.data;
                        newLocalProducts.count = result.data.length;
                        localStorage.setItem('ops-products', JSON.stringify(newLocalProducts));
                        $.each(result.data, function (key, val) {
                            total += (val.price * val.count);
                            var statusClass = '';
                            if (val.status == 0) {
                                statusClass = 'red-border';
                            }

                            dataTxt += '\
                            <div class="cartProductItem ' + statusClass + '">\
                            <input type="hidden" name="key" value="' + key + '" />\
                            <div class="row">\
                            <div class="col-md-6 col-sm-12">\
                            <div class="cardArea-box cardArea-info">\
                            <h2>\
                            Ürün\
                            </h2>\
                            </div>\
                            <div class="cart_product_info">\
                            <div class="productImg"><img src="'+site_url+'assets/products/'+val.kod3+'.png" alt=""></div>\
                            <div class="productInfo">\
                            <a href="'+site_url + val.url + '" class="product-link">' + val.name + '</a>\
                            <p>Adet : ' + val.count + '</p>\
                            <p>Ürün Kodu : ' + val.stok_kodu + '</p>\
                            </div>\
                            </div>\
                            </div>\
                            <div class="col-md-6 col-sm-12">\
                            <div class="row">\
                            <div class="col-md-8 col-sm-8 col-8">\
                            <div class="price-solo-box cardArea-box">\
                            <div class="price-solo">\
                            <h2>\
                            Fiyat\
                            </h2>\
                            <div class="priceInfo">\
                            <div class="price">' + currencyFormatDE(val.price) + ' TL<span class="old">' + currencyFormatDE(val.oldPrice) + 'TL</span></div>\
                            </div>\
                            </div>\
                            <div class="basket-quantity-box">\
                            <div class="cardArea-box cardArea-piece">\
                            <h2>\
                            Adet\
                            </h2>\
                            </div>\
                            <div class="quantity-area">\
                            <div class="value-button catCountChange" id="decrease" onclick="decreaseValue(' + val.artis + ',\'' + val.stok_kodu + key + '\')" value="Decrease Value">-</div>\
                            <input type="number" name="number_' + val.stok_kodu + key + '" id="number" value="' + val.count + '">\
                            <div class="value-button catCountChange" id="increase" onclick="increaseValue(' + val.artis + ',\'' + val.stok_kodu + key + '\')" value="Increase Value">+</div>\
                            </div>\
                            </div>\
                            </div> \
                            </div>\
                            <div class="col-md-4 col-sm-4 col-4">\
                            <div class="cardArea-box cardArea-total">\
                            <h2>\
                            Tutar\
                            </h2>\
                            <div class="priceInfo">\
                            <div class="price">' + currencyFormatDE(val.price * val.count) + ' TL<span class="old">' + currencyFormatDE(val.oldPrice * val.count) + 'TL</span></div>\
                            </div>\
                            </div>\
                            </div>\
                            </div>\
                            </div>\
                            </div>\
                            <div class="removeCart" onclick="cartProductDelCartPage(' + key + ')"><i class="fa fa-trash-o" aria-hidden="true"></i></div>\
                            </div>';
                        });

                        if (result.cargo == 0) {
                            cargo = Number(0);
                            $('.kargoPrice').text('Ücretsiz');
                            $('.cargoEksik').css('display','none');
                        } else {
                            cargo = Number(result.cargo);
                            $('.kargoPrice').text(currencyFormatDE(cargo) + ' TL');
                            $('.cargoEksik').css('display','block');
                            $('.cargoEksik > .alert').html('Sepetinize <b>'+currencyFormatDE(result.minCargo-total)+'</b> TL lik Ürün Daha Eklerseniz <b>Kargo Bedava</b>');

                        }
                        $('.cartArea').html(dataTxt);
                        $('.araToplamPrice').text(currencyFormatDE(total / 1.18) + ' TL');
                        var kdvPrice = (total - total / 1.18);
                        $('.kdvPrice').text(currencyFormatDE(kdvPrice) + ' TL');
                        $('.totalPrice').text(currencyFormatDE(total + cargo) + ' TL');

                        $('.urunVar').css('display', 'flex');
                        $('.urunYok').css('display', 'none');
                        $('.yukleninceKapat').css('display', 'none');
                    } else {
                        $('.urunVar').css('display', 'none');
                        $('.urunYok').css('display', 'flex');
                        $('.yukleninceKapat').css('display', 'none');
                    }

                    $.unblockUI();
                },
                error: function (result) {
                    $('.urunVar').css('display', 'none');
                    $('.urunYok').css('display', 'flex');
                    $('.yukleninceKapat').css('display', 'none');
                    $.unblockUI();
                    Swal.fire({
                        type: 'error',
                        title: 'Hata !',
                        html: 'Üzgünüz Teknik Bir Sorun İle Karşı Karşıyayız',
                        animation: false,
                    });
                }
            });
        } else {
            $.unblockUI();
            $('.urunVar').css('display', 'none');
            $('.urunYok').css('display', 'flex');
            $('.yukleninceKapat').css('display', 'none');
        }
    } else {
        $.unblockUI();
        $('.urunVar').css('display', 'none');
        $('.urunYok').css('display', 'flex');
        $('.yukleninceKapat').css('display', 'none');
    }
}

function addReminding(url) {
    loader();
    $.ajax({
        url: site_url + 'ajax/addReminding',
        method: 'POST',
        dataType: 'JSON',
        data: {url:url},
        success: function (result) {
            if (result.error == 0) {
                $.unblockUI();
                if (result.status == 2) {
                    $('.fa-bell-o').addClass('fav-active');
                    Swal.fire({
                        type: 'success',
                        title: 'Ürün Favorilere Eklendi',
                        html: '<center>Ürün başarıyla favori listesine eklendi</center>',
                        animation: false,
                    });
                }else{
                    $('.fa-bell-o').removeClass('fav-active');
                    Swal.fire({
                        type: 'error',
                        title: 'Ürün Favorilerden Silindi',
                        html: '<center>Ürün başarıyla favori listesinden silindi</center>',
                        animation: false,
                    });
                }
            }else{
                $.unblockUI();
                if (result.error == 2) {
                    Swal.fire({
                        html: "<center>Ürünü Favorilere Eklemek İçin Giriş Yapmalısınız</center>",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#dd631f',
                        cancelButtonColor: '#188acc',
                        confirmButtonText: 'Giriş Yap',
                        cancelButtonText: "Kayıt Ol"
                    }).then((result) => {
                        if (result.value) {
                            window.location = site_url + 'giris-yap?redirect=' + window.location.href;
                        } else if (result.dismiss == 'cancel') {
                            window.location = site_url + 'kayit-ol?redirect=' + window.location.href;
                        }
                    });
                }else{
                    Swal.fire({
                        type: 'error',
                        title: 'Hata !',
                        confirmButtonText: 'Tamam',
                        html: '<p style="text-align:center;">Üzgünüz Teknik Bir Hata Oluştu</p>',
                        animation: false,
                        
                    });
                }
            }
        },
        error: function (result) {
            
            $.unblockUI();
            Swal.fire({
                type: 'error',
                title: 'Hata !',
                confirmButtonText: 'Tamam',
                html: '<p style="text-align:center;">Üzgünüz Teknik Bir Hata Oluştu</p>',
                animation: false,
                
            });
        }
    });
}

function addFavorite(url) {
    loader();
    $.ajax({
        url: site_url + 'ajax/addFavorite',
        method: 'POST',
        dataType: 'JSON',
        data: {url:url},
        success: function (result) {
            if (result.error == 0) {
                $.unblockUI();
                if (result.status == 2) {
                    $('.fa-heart-o').addClass('fav-active');
                    Swal.fire({
                        type: 'success',
                        title: 'Ürün Favorilere Eklendi',
                        html: '<center>Ürün başarıyla favori listesine eklendi</center>',
                        animation: false,
                    });
                }else{
                    $('.fa-heart-o').removeClass('fav-active');
                    Swal.fire({
                        type: 'error',
                        title: 'Ürün Favorilerden Silindi',
                        html: '<center>Ürün başarıyla favori listesinden silindi</center>',
                        animation: false,
                    });
                }
            }else{
                $.unblockUI();
                if (result.error == 2) {
                    Swal.fire({
                        html: "<center>Ürünü Favorilere Eklemek İçin Giriş Yapmalısınız</center>",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#dd631f',
                        cancelButtonColor: '#188acc',
                        confirmButtonText: 'Giriş Yap',
                        cancelButtonText: "Kayıt Ol"
                    }).then((result) => {
                        if (result.value) {
                            window.location = site_url + 'giris-yap?redirect=' + window.location.href;
                        } else if (result.dismiss == 'cancel') {
                            window.location = site_url + 'kayit-ol?redirect=' + window.location.href;
                        }
                    });
                }else{
                    Swal.fire({
                        type: 'error',
                        title: 'Hata !',
                        confirmButtonText: 'Tamam',
                        html: '<p style="text-align:center;">Üzgünüz Teknik Bir Hata Oluştu</p>',
                        animation: false,
                        
                    });
                }
            }
        },
        error: function (result) {
            
            $.unblockUI();
            Swal.fire({
                type: 'error',
                title: 'Hata !',
                confirmButtonText: 'Tamam',
                html: '<p style="text-align:center;">Üzgünüz Teknik Bir Hata Oluştu</p>',
                animation: false,
                
            });
        }
    });
}

function sepetiOnaylaAddress(){
    var data = {}
    data.fatura         = $('[name=fatura]').prop('checked');
    data.address        = 0;
    data.invoceAddress  = 0;

    $.each($('.adrressRadio'),function(key,val){
        if ($(val).prop('checked')) {
            data.address = $(val).val();
        }
    });

    $.each($('.faturaRadio'),function(key,val){
        if ($(val).prop('checked')) {
            data.invoceAddress = $(val).val();
        }
    });

    if (data.fatura == true) {
        if (data.address == 0 || data.invoceAddress == 0) {
            Swal.fire({
                type: 'error',
                title: 'Hata !',
                text: 'Lütfen İlerlemek İçin Adres Seçiniz',
                animation: false,
                customClass: 'animated tada'
            });
        }else{
            goToCardPage(data.address,data.invoceAddress);
        }
    }else{
        if (data.address == 0) {
            Swal.fire({
                type: 'error',
                title: 'Hata !',
                text: 'Lütfen İlerlemek İçin Adres Seçiniz',
                animation: false,
                customClass: 'animated tada'
            });
        }else{
            goToCardPage(data.address,data.invoceAddress);
        }
    }
}

function goToCardPage(address,invoceAddress) {
    $.ajax({
        method: 'post',
        dataType: 'json',
        url: site_url + 'Ajax/goToCardPage/'+address+'/'+invoceAddress,
        success: function(result) {
            if (result.status == 2) {
                alert('üye Girişi');
            }else if (result.status == 3) {
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    text: result.errCode,
                    animation: false,
                    customClass: 'animated tada'
                });
            }else if (result.status == 1) {
                window.location.href = site_url+'sepet/odeme';
            }else{
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    text: 'Bağlantı Hatası !',
                    animation: false,
                    customClass: 'animated tada'
                });
            }
        },
        error: function() {
            Swal.fire({
                type: 'error',
                title: 'Hata !',
                text: 'Bağlantı Hatası !',
                animation: false,
                customClass: 'animated tada'
            });
        }
    });
}

function cartAddressUpdate(id) {
    Swal.fire({
        title: 'Güncelleme İşlemi',
        text: "Seçili adresinizi güncellmek istediğinize emin misiniz ?",
        type: 'error',
        showCancelButton: true,
        confirmButtonColor: '#DD631F',
        cancelButtonColor: '#1889CB',
        confirmButtonText: 'Evet',
        cancelButtonText: 'Vazgeç'
    }).then((result) => {
        if (result.value) {
            loader();
            var data = {};
            if ($('#kurumsal_'+id).prop('checked')) {
                data.corporate = 1;
            }else{
                data.corporate = 0;
            }

            data.definition         = $('#definition_'+id).val();
            data.name               = $('#name_'+id).val();
            data.gsm                = $('#gsm_'+id).val();
            data.post_code          = $('#post_code_'+id).val();
            data.identity_number    = $('#identity_number_'+id).val();
            data.country            = $('#country_'+id).val();
            data.city               = $('#city_'+id).val();
            data.town               = $('#town_'+id).val();
            data.content            = $('#content_'+id).val();
            data.firm_name          = $('#firm_name_'+id).val();
            data.tax_no             = $('#tax_no_'+id).val();
            data.tax_admin          = $('#tax_admin_'+id).val();
            data.default            = 1;
            data.update_id          = id;

            $.ajax({
                url: site_url+'Ajax/updateAddress/',
                method:'POST',
                dataType : 'JSON',
                data:data,
                success: function(result){
                    if (result.status == false) {
                        $.unblockUI();
                        Swal.fire({type: 'error', title: 'Hata !', html: result.error, animation: false, customClass: 'animated tada'});
                    }else{
                        location.reload();
                    }
                },error:function(result) {
                    $.unblockUI();
                    Swal.fire({type: 'error', title: 'Hata !', html: 'Üzgünüz Teknik Bir Sorun İle Karşı Karşıyayız', animation: false, customClass: 'animated tada'});
                }
            });
        }
    });
}

function removeAddress(id) {
    Swal.fire({
        title: 'Silme İşlemi',
        text: "Aracı Garajınızdan silmek istediğinize emin misiniz ?",
        type: 'error',
        showCancelButton: true,
        confirmButtonColor: '#DD631F',
        cancelButtonColor: '#1889CB',
        confirmButtonText: 'Evet Sil',
        cancelButtonText: 'Vazgeç'
    }).then((result) => {
        if (result.value) {
            loader();
            $.ajax({
                url: site_url+'Ajax/addressRemove/'+id,
                method:'POST',
                dataType : 'JSON',
                success: function(result){
                    if (result.status == false) {
                        $.unblockUI();
                        Swal.fire({type: 'error', title: 'Hata !', html: result.error, animation: false, customClass: 'animated tada'});
                    }else{
                        location.reload();
                    }
                },error:function(result) {
                    $.unblockUI();
                    Swal.fire({type: 'error', title: 'Hata !', html: 'Üzgünüz Teknik Bir Sorun İle Karşı Karşıyayız', animation: false, customClass: 'animated tada'});
                }
            });
        }
    });
}

function cartAddressAdd() {
    var data = {};
    if ($('#kurumsal_new').prop('checked')) {
        data.corporate = 1;
    }else{
        data.corporate = 0;
    }

    data.definition         = $('#address_title_new').val();
    data.name               = $('#address_name_new').val();
    data.gsm                = $('#address_gsm_new').val();
    data.post_code          = $('#post_code_new').val();
    data.identity_number    = $('#identity_number_new').val();
    data.country            = $('#address_country_new').val();
    data.city               = $('#address_city_new').val();
    data.town               = $('#address_town_new').val();
    data.content            = $('#address_address_new').val();
    data.firm_name          = $('#company_name_new').val();
    data.tax_no             = $('#company_vergi_new').val();
    data.tax_admin          = $('#company_vergidairesi_new').val();

    $.ajax({
        url: site_url+'Ajax/addAddress/',
        method:'POST',
        dataType : 'JSON',
        data:data,
        success: function(result){
            if (result.status == false) {
                Swal.fire({type: 'error', title: 'Hata !', html: result.error, animation: false, customClass: 'animated tada'});
            }else{
                location.reload();
            }
        },error:function(result) {
            Swal.fire({type: 'error', title: 'Hata !', html: 'Üzgünüz Teknik Bir Sorun İle Karşı Karşıyayız', animation: false, customClass: 'animated tada'});
        }
    });
}

function addNewCarModal() {
    Swal.fire({
        title: 'Yöntem Seçin',
        text: "Lütfen garajınıza eklemek istediğiniz aracın hangi yöntem ile ekleyeceğinizi Seçin",
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#DD631F',
        cancelButtonColor: '#1889CB',
        confirmButtonText: 'Şase No İle',
        cancelButtonText: 'Araç Ağacı İle'
    }).then((result) => {
        if (result.value == true) {
            $('#saseFirst').modal();
        }else if(result.dismiss == "cancel"){
            $('#carTree').modal();
        }
    })
}

function removeCar(id) {
    Swal.fire({
        title: 'Silme İşlemi',
        text: "Aracı Garajınızdan silmek istediğinize emin misiniz ?",
        type: 'error',
        showCancelButton: true,
        confirmButtonColor: '#DD631F',
        cancelButtonColor: '#1889CB',
        confirmButtonText: 'Evet Sil',
        cancelButtonText: 'Vazgeç'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: site_url+'Service/deleteGarageCar/'+id,
                method:'POST',
                success: function(result){
                    if (result == 'OK') {
                        Swal.fire(
                            'Silindi!',
                            'Araç Garajınızdan Başarı ile Silindi.',
                            'success'
                            )
                        window.location = site_url+'Account/garage';
                    }else{
                        swalWithBootstrapButtons.fire(
                            'Silinemedi',
                            'Teknik bir hata ile karşılaştık. Lütfen daha sonra tekrar deneyin.',
                            'error'
                            )
                    }
                },
                error: function (result) {
                    swalWithBootstrapButtons.fire(
                        'Silinemedi',
                        'Teknik bir hata ile karşılaştık. Lütfen daha sonra tekrar deneyin.',
                        'error'
                        )
                }
            });
        }
    })
}

function orderCancel(order_id) {
    Swal.fire({
        title: 'Sipariş iptali',
        text: order_id+" Numaralı siparişinizi iptal etmek istediğinize emin misiniz ?",
        type: 'error',
        animation: 'bouncelnDown',
        showCancelButton: true,
        confirmButtonColor: '#DD631F',
        cancelButtonColor: '#1889CB',
        confirmButtonText: 'Evet',
        cancelButtonText: 'Vazgeç'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: site_url+'Ajax/cancelOrder/'+order_id,
                method:'POST',
                dataType:'JSON',
                success: function(result){
                    console.log(result);
                    if (result.status == true) {
                        Swal.fire(
                            'Sipariş İptali!',
                            'Siparişiniz İptal Edilmiştir.',
                            'success'
                        );
                        location.reload();
                    }else{
                        Swal.fire(
                            'Sipariş İptali!',
                            'Siparişiniz İptal Edilirken Hata Oluştu. Sayfayı yenileyerek Tekrar Deneyebilirsiniz.',
                            'error'
                        );
                    }
                },
                error: function (result) {
                    Swal.fire(
                        'Sipariş İptali!',
                        'Siparişiniz İptal Edilirken Hata Oluştu. Lütfen Daha Sonra Tekrar Deneyin.',
                        'error'
                    );
                }
            });
        }
    })
}

var star = '';
$(document).on('click','.star', function() {
    star = $(this).data('value');
});

/*Stick Head */
$(window).scroll(function () {
    var scroll = $(window).scrollTop();
    if (scroll >= 30) {
        $("header").addClass("Sticklendin");
        $("nav.NavMenu.p-lr").addClass("fixadd");
    } else {
        $("header.Stikclendin").fadeOut(100);
        $("header").removeClass("Sticklendin");
        $("nav.NavMenu.p-lr").removeClass("fixadd");
    }
});

$(document).on('keypress', function(e) {
    var getTriggerUrl = window.location.pathname;
    if (e.which == 13) {
        if (getTriggerUrl == '/giris-yap') {
            $('#login').trigger('click');
        } else if (getTriggerUrl == '/kayit-ol') {
            $('#register').trigger('click');
        } else if (getTriggerUrl == '/sifremi-unuttum') {
            $('#renew_password').trigger('click');
        }else if (getTriggerUrl.split('/')[1] == 'sifre-yenileme') {
            $('#password_save').trigger('click');
        }
    }
});

$(document).on('keyup', '.jquery_filter', function () {
    var debug = false;
    var $wrapper = $($(this).attr('data-search-items-wrapper-id'));
    var $search_item_div = $wrapper.find($(this).attr('data-search-item-class'));
    if ($.trim($(this).val()) == "") {
        $search_item_div.removeClass('hidden');
        $wrapper.find('.not_found_div').remove();
    } else {
        var search_tokens = $.trim($(this).val()).split(' ');
        if (debug) {
            console.log("Search Tokens : " + search_tokens);
        }
        var search_classes = $(this).attr('data-search-classes').split(',');
        var matching_count = 0;
        $search_item_div.each(function () {
            var cur_div = $(this);
            var div_str = "";
            $.each(search_classes, function (index, value) {
                if (debug) {
                    console.log("Search Class = " + value);
                    console.log("Search Class Value = " + cur_div.find(value).text());
                }
                div_str += " " + cur_div.find(value).text();
            });
            if (debug) {
                console.log("Div Str : " + div_str);
            }
            $.each(search_tokens, function (index, value) {
                if (value) {
                    var re = new RegExp(value, "i");
                    if (re.test(div_str)) {
                        cur_div.removeClass('hidden');
                        matching_count += 1;
                    } else {
                        cur_div.addClass('hidden');
                    }
                }
            });
            if (debug) {
                console.log("Matching Count : " + matching_count);
            }
            if (matching_count == 0) {
                if ($wrapper.find('.not_found_div').length > 0) {
                    $wrapper.find('.not_found_div').removeClass("hidden");
                } else {
                    $wrapper.append("<div class='not_found_div' style='color:#888; text-align:center; font-size:13px;'> Bulunamadi. </div>");
                }
            } else {
                $wrapper.find('.not_found_div').addClass("hidden");
            }
        });
    }
});

var cargo = 0;
/*catCountChange*/
$(document).on('click', '.catCountChange', function () {
    loader();
    updateCart();
    getCart();
});

$(document).on('click','#sendReview',function(){
    reviewInformation = {};
    reviewInformation.star = star;
    reviewInformation.product_quality = ( $('#product_quality').is(':checked') ) ? 0 : 1;
    reviewInformation.ease_of_use = ( $('#ease_of_use').is(':checked') ) ? 0 : 1;
    reviewInformation.fast_shipping = ( $('#fast_shipping').is(':checked') ) ? 0 : 1;
    reviewInformation.price_range = ( $('#price_range').is(':checked') ) ? 0 : 1;
    reviewInformation.product_packaging = ( $('#product_packaging').is(':checked') ) ? 0 : 1;
    reviewInformation.message = $('#message').val();
    star = '';
    $.ajax({
        method : 'post',
        dataType : 'json',
        data : reviewInformation,
        url: site_url + 'Ajax/sendReview',
        success: function(result){
            if (result.status == true) {
                $('#message').val('');
                Swal.fire({title:'Başarılı!', html: 'Bizi Değerlendirdiğiniz İçin Teşekkür Ederiz.', type:'success'});
                $('.swal2-confirm').click(function(){
                    window.location.href = result.redirect_url;
                });
            } else {
                Swal.fire({title:'Uyarı !', html: result.error, type:'warning'});
            }
        }, error: function() {
            Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, });
        }
    });
});

$(document).on('change','.edicCountry',function() {
    var id = $(this).attr('data-id');
    var selected = $(this).val();
    if (id != 0 || id != '') {
        $.ajax({
            method: 'post',
            dataType: 'json',
            url: site_url + 'Ajax/getCitiesByCountry/' + selected,
            success: function(result) {
                if (result.status) {
                    var html = '<option name="0">Seçiniz</option>';
                    $.each(result.array, function(key, value) {
                        html += '<option value=' + value.CityID + '>' + value.CityName + '</option>';
                    });
                    $('#city_'+id).html(html);
                    $('#town_'+id).html('<option name="0">Seçiniz</option>');
                }else{
                    $('#city_'+id).html('<option name="0">Seçiniz</option>');
                    $('#town_'+id).html('<option name="0">Seçiniz</option>');
                }
            },
            error: function() {
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    text: 'Bağlantı Hatası !',
                    animation: false,
                    customClass: 'animated tada'
                });
            }
        });
    }
});

$(document).on('change','.editCity',function() {
    var id = $(this).attr('data-id');
    var selected = $(this).val();
    if (id != 0 || id != '') {
        $.ajax({
            method: 'post',
            dataType: 'json',
            url: site_url + 'Ajax/getCountiesByCities/' + selected,
            success: function(result) {
                if (result.status) {
                    var html = '<option name="0">Seçiniz</option>';
                    $.each(result.array, function(key, value) {
                        html += '<option value=' + value.CountyID + '>' + value.CountyName + '</option>';
                    });
                    $('#town_'+id).html(html);
                }else{
                    $('#town_'+id).html('<option name="0">Seçiniz</option>');
                }
            },
            error: function() {
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    text: 'Bağlantı Hatası !',
                    animation: false,
                    customClass: 'animated tada'
                });
            }
        });
    }
});

$(document).on('change','.kurumsal_update',function() {
    var id = $(this).data('id');
    if ($(this).data('type') == 'kurumsal'){
        $('.kurumsal_'+id).css('display','block');
    }else{
        $('.kurumsal_'+id).css('display','none');
    }
});

$(document).on('change','#fatura',function(){
    if ($(this).prop('checked')) {
        $('.fatura').css('display','block');
    }else{
        $('.fatura').css('display','none');
    }
});

$(document).on('change','.KurumsalAdresCheckbox',function(){
    if ($(this).data('type') == 'kurumsal') {
        $('.kurumsal').css('display','block');
    }else{
        $('.kurumsal').css('display','none');
    }
});

$(document).on('change','.ilce',function() {
    var name = $(' > option:selected',this).text();
    var id = $(this).attr('select-id');
    $('#CountyName_'+id).val(name);
});

$(document).on('change','#address_country_new',function() {
    var id = $('#address_country_new').val();
    if (id != 0 || id != '') {
        $.ajax({
            method: 'post',
            dataType: 'json',
            url: site_url + 'Ajax/getCitiesByCountry/' + id,
            success: function(result) {
                if (result.status) {
                    var html = '<option name="0">Seçiniz</option>';
                    $.each(result.array, function(key, value) {
                        html += '<option value=' + value.CityID + '>' + value.CityName + '</option>';
                    });
                    $('#address_city_new').html(html);
                    $('#address_town_new').html('<option name="0">Seçiniz</option>');
                }else{
                    $('#address_city_new').html('<option name="0">Seçiniz</option>');
                    $('#address_town_new').html('<option name="0">Seçiniz</option>');
                }
            },
            error: function() {
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    text: 'Bağlantı Hatası !',
                    animation: false,
                    customClass: 'animated tada'
                });
            }
        });
    }
});

$(document).on('change','#address_city_new',function() {
    var id = $('#address_city_new').val();
    if (id != 0 || id != '') {
        $.ajax({
            method: 'post',
            dataType: 'json',
            url: site_url + 'Ajax/getCountiesByCities/' + id,
            success: function(result) {
                if (result.status) {
                    var html = '<option name="0">Seçiniz</option>';
                    $.each(result.array, function(key, value) {
                        html += '<option value=' + value.CountyID + '>' + value.CountyName + '</option>';
                    });
                    $('#address_town_new').html(html);
                }
            },
            error: function() {
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    text: 'Bağlantı Hatası !',
                    animation: false,
                    customClass: 'animated tada'
                });
            }
        });
    }
});

/*Contact Module*/
$(document).on('click','#sendContactForm',function(){
    var contactInformation = {};
    contactInformation.contactNameSurname = $('#contactNameSurname').val(); 
    contactInformation.contactMail = $('#contactMail').val();   
    contactInformation.contactPhone = $('#contactPhone').val(); 
    contactInformation.contactSubject = $('#contactSubject').val(); 
    contactInformation.contactMessage = $('#contactMessage').val();
    $.ajax({
        method: 'post',
        dataType: 'json',
        data : contactInformation,
        url: site_url+'Ajax/sendContactForm',
        success: function(result){
            if (result.status == true) {
                Swal.fire({type: 'success', title: 'Başarılı !', html: 'Bilgilerinizi Aldık, En Kısa Zamanda Size Geri Dönüş Sağlayacağız.', animation: false, customClass: 'animated tada'});
                $('.swal2-confirm').click(function(){
                    window.location.href = window.location.href;
                });
            } else {
                Swal.fire({type: 'error', title: 'Hata !', html: result.error, animation: false, customClass: 'animated tada'});
            }
        }, error: function() {
            Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
        }
    });
});

/*Update Address*/
$(document).on('click','.addressUpdate',function() {
    Swal.fire({
        title: 'Güncelleme İşlemi',
        text: "Adresinizi güncellemek istediğinize emin misiniz ?",
        type: 'error',
        showCancelButton: true,
        confirmButtonColor: '#DD631F',
        cancelButtonColor: '#1889CB',
        confirmButtonText: 'Evet',
        cancelButtonText: 'Vazgeç'
    }).then((result) => {
        if (result.value) {
            loader();
            var id = $(this).data('id');
            var updateInformation = {};
            updateInformation.definition        = $('#definition_'+id).val();
            updateInformation.name              = $('#name_'+id).val();
            updateInformation.gsm               = $('#gsm_'+id).val();
            updateInformation.post_code         = $('#post_code_'+id).val();
            updateInformation.country           = $('#country_'+id).val();
            updateInformation.city              = $('#city_'+id).val();
            updateInformation.town              = $('#town_'+id).val();
            updateInformation.identity_number   = $('#identity_number_'+id).val();
            updateInformation.content           = $('#content_'+id).val();
            updateInformation.update_id         = id;
            if ($('#kurumsalCheck_'+id).is(':checked')) {
                updateInformation.firm_name     = $('#firm_name_'+id).val();
                updateInformation.tax_no        = $('#tax_no_'+id).val();
                updateInformation.tax_admin     = $('#tax_admin_'+id).val();
                updateInformation.corporate     = 1;
            }

            $.ajax({
                method: 'post',
                dataType: 'json',
                data : updateInformation,
                url: site_url + 'Ajax/updateAddress',
                success: function(result){
                    if (result.status == true) {
                        $.unblockUI();
                        Swal.fire({title:'Başarılı!', html: 'Adresiniz Güncellendi !', type:'success'});
                        $( '.close' ).trigger( 'click' );
                        $('.swal2-confirm').click(function(){
                            window.location.href = result.redirect_url;
                        });
                    } else {
                        $.unblockUI();
                        Swal.fire({type: 'error', title: 'Hata !', html: result.error, animation: false, customClass: 'animated tada'});
                    }
                }, error: function() {
                        $.unblockUI();
                    Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
                }
            });
        }
    });
});

/*Password Renew*/ 
$(document).on('click','#renew_password',function() {
    $('#renew_password').prop('disabled', true);
    var renewInformation = {};
    renewInformation.email = $('#forgot_email').val();
    $.ajax({
        method: 'post',
        dataType: 'json',
        data: renewInformation,
        url: site_url + 'Ajax/renewPassword',
        success: function(result) {
            if (result.status == true) {
                Swal.fire({
                    title: 'Başarılı!',
                    html: 'Şifre Sıfırlama Bağlantınız, Girdiğiniz E-Posta Adresinize Gönderildi.',
                    type: 'success'
                });
                $('.swal2-confirm').click(function() {
                    window.location.href = result.redirect_url;
                });
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    html: result.error,
                    animation: false,
                    customClass: 'animated tada'
                });
                $('.swal2-confirm').click(function() {
                    $('#renew_password').prop('disabled', false);
                });
            }
        },
        error: function() {
            Swal.fire({
                type: 'error',
                title: 'Hata !',
                text: 'Bağlantı Hatası !',
                animation: false,
                customClass: 'animated tada'
            });
            $('.swal2-confirm').click(function() {
                $('#renew_password').prop('disabled', false);
            });
        }
    });
});

/*New Password Save*/
$(document).on('click','#password_save',function() {
    $('#password_save').prop('disabled', true);
    var resetInformation = {};
    resetInformation.email = $('#refresh_email').val();
    resetInformation.password = $('#refresh_password').val();
    resetInformation.password_repeat = $('#refresh_password_repeat').val();
    resetInformation.remember_key = $('#refresh_key').val();
    $.ajax({
        method: 'post',
        dataType: 'json',
        data: resetInformation,
        url: site_url + 'Ajax/refreshPassword',
        success: function(result) {
            if (result.status == true) {
                Swal.fire({
                    title: 'Başarılı!',
                    html: 'Şifreniz Güncellendi, Yeni Bilgileriniz İle Giriş Yapabilirsiniz.',
                    type: 'success'
                });
                $('.swal2-confirm').click(function() {
                    window.location.href = result.redirect_url;
                });
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    html: result.error,
                    animation: false,
                    customClass: 'animated tada'
                });
                $('.swal2-confirm').click(function() {
                    $('#password_save').prop('disabled', false);
                });
            }
        },
        error: function() {
            Swal.fire({
                type: 'error',
                title: 'Hata !',
                text: 'Bağlantı Hatası !',
                animation: false,
                customClass: 'animated tada'
            });
            $('.swal2-confirm').click(function() {
                $('#password_save').prop('disabled', false);
            });
        }
    });
});

/*Notification Settings*/ 
$(document).on('click','#notification_settings_update',function() {
    var notificationInformation = {};
    notificationInformation.campaign_email = ($('#campaign_email').is(':checked')) ? 1 : 0;
    notificationInformation.campaign_sms = ($('#campaign_sms').is(':checked')) ? 1 : 0;
    notificationInformation.basket_email = ($('#basket_email').is(':checked')) ? 1 : 0;
    notificationInformation.cargo_sms = ($('#cargo_sms').is(':checked')) ? 1 : 0;
    notificationInformation.favorites_product_email = ($('#favorites_product_email').is(':checked')) ? 1 : 0;
    notificationInformation.marketing_call = ($('#marketing_call').is(':checked')) ? 1 : 0;
    $.ajax({
        method: 'post',
        dataType: 'json',
        data: notificationInformation,
        url: site_url + 'Ajax/updateNotification',
        success: function(result) {
            if (result.status == true) {
                Swal.fire({
                    title: 'Başarılı!',
                    html: 'Bildirim Ayarlarınız Güncellendi.',
                    type: 'success'
                });
                $('.swal2-confirm').click(function() {
                    window.location.href = result.redirect_url;
                });
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    html: result.error,
                    animation: false,
                    customClass: 'animated tada'
                });
            }
        },
        error: function() {
            Swal.fire({
                type: 'error',
                title: 'Hata !',
                text: 'Bağlantı Hatası !',
                animation: false,
                customClass: 'animated tada'
            });
        }
    });
});

/*İban Add*/ 
$(document).on('click','#ibanAdd',function() {
    var ibanInformation = {};
    ibanInformation.ibanStatus = $("#ibanStatus option:selected").val();
    ibanInformation.ibanNumber = $('#ibanNumber').val();
    ibanInformation.ibanNameSurname = $('#ibanNameSurname').val();
    ibanInformation.ibanBank = $('#ibanBank').val();
    $.ajax({
        method: 'post',
        dataType: 'json',
        data: ibanInformation,
        url: site_url + 'Ajax/addIbanInformation',
        success: function(result) {
            if (result.status == true) {
                Swal.fire({
                    title: 'Başarılı!',
                    html: 'İban Bilgileriniz Eklendi.',
                    type: 'success'
                });
                $('.swal2-confirm').click(function() {
                    window.location.href = result.redirect_url;
                });
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    html: result.error,
                    animation: false,
                    customClass: 'animated tada'
                });
            }
        },
        error: function() {
            Swal.fire({
                type: 'error',
                title: 'Hata !',
                text: 'Bağlantı Hatası !',
                animation: false,
                customClass: 'animated tada'
            });
        }
    });
});

/*Transfer Add*/
$(document).on('click','#transferAddInformation',function() {
    var transferInformation = {};
    transferInformation.transferNameSurname = $('#transferNameSurname').val();
    transferInformation.transferEmail = $('#transferEmail').val();
    transferInformation.transferPhone = $('#transferPhone').val();
    transferInformation.transferOrderNumber = $('#transferOrderNumber').val();
    transferInformation.transferBankId = $("#transferBankId option:selected").val();
    transferInformation.transferAmount = $('#transferAmount').val();
    transferInformation.transferMessage = $('#transferMessage').val();
    $.ajax({
        method: 'post',
        dataType: 'json',
        data: transferInformation,
        url: site_url + 'Ajax/transferInformationAdd',
        success: function(result) {
            if (result.status == true) {
                Swal.fire({
                    title: 'Başarılı!',
                    html: 'Havale Ödeme Bilgileriniz Eklendi.',
                    type: 'success'
                });
                $('.swal2-confirm').click(function() {
                    window.location.href = result.redirect_url;
                });
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    html: result.error,
                    animation: false,
                    customClass: 'animated tada'
                });
            }
        },
        error: function() {
            Swal.fire({
                type: 'error',
                title: 'Hata !',
                text: 'Bağlantı Hatası !',
                animation: false,
                customClass: 'animated tada'
            });
        }
    });
});

/*Modal Web Site Review*/
$(document).on('click','#modalReviewSend',function() {
    var modalReviewInformation = {};
    modalReviewInformation.deviceType = $('input[name=deviceType]:checked').val();
    modalReviewInformation.generalpageRate = $('input[name=generalpageRate]:checked').val();
    modalReviewInformation.modalReviewMessage = $('#modalReviewMessage').val();
    $.ajax({
        method: 'post',
        dataType: 'json',
        data: modalReviewInformation,
        url: site_url + 'Ajax/modalReviewInformationAdd',
        success: function(result) {
            if (result.status == true) {
                $('#modalReviewClose').trigger('click');
                Swal.fire({
                    title: 'Başarılı!',
                    html: 'Değerlendirmeniz Bizim İçin Çok Önemli. Teşekkürlerimizi Sunuyoruz.',
                    type: 'success'
                });
                $('.swal2-confirm').click(function() {
                    window.location.href = window.location.href;
                });
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    html: result.error,
                    animation: false,
                    customClass: 'animated tada'
                });
            }
        },
        error: function() {
            Swal.fire({
                type: 'error',
                title: 'Hata !',
                text: 'Bağlantı Hatası !',
                animation: false,
                customClass: 'animated tada'
            });
        }
    });
});

/*Newsletter Email */
$(document).on('click','#newsletterMailSend',function() {
    var newsletterInformation = {};
    newsletterInformation.newsletterEMail = $('#newsletterEMail').val();
    $.ajax({
        method: 'post',
        dataType: 'json',
        data: newsletterInformation,
        url: site_url + 'Ajax/newsletterMailSend',
        success: function(result) {
            if (result.status == true) {
                Swal.fire({
                    title: 'Başarılı!',
                    html: 'Bültenimize Kayıt Olduğunuz İçin Teşekkürler.',
                    type: 'success'
                });
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    html: result.error,
                    animation: false,
                    customClass: 'animated tada'
                });
            }
        },
        error: function() {
            Swal.fire({
                type: 'error',
                title: 'Hata !',
                text: 'Bağlantı Hatası !',
                animation: false,
                customClass: 'animated tada'
            });
        }
    });
});

/*Send Requests*/
$(document).on('click','#sendSupportRequests',function() {
    $('#sendSupportRequests').prop('disabled', true);
    var requestInformation = {};
    requestInformation.supportSection = $("#supportSection option:selected").val();
    requestInformation.supportSubject = $('#supportSubject').val();
    requestInformation.supportMessage = $('#supportMessage').val();
    $.ajax({
        method: 'post',
        dataType: 'json',
        data: requestInformation,
        url: site_url + 'Ajax/sendSupportRequests',
        success: function(result) {
            if (result.status == true) {
                Swal.fire({
                    title: 'Başarılı!',
                    html: 'Destek Talebiniz Oluşturuldu.',
                    type: 'success'
                });
                $('.swal2-confirm').click(function() {
                    window.location.href = result.redirect_url;
                });
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    html: result.error,
                    animation: false,
                    customClass: 'animated tada'
                });
            }
        },
        error: function() {
            Swal.fire({
                type: 'error',
                title: 'Hata !',
                text: 'Bağlantı Hatası !',
                animation: false,
                customClass: 'animated tada'
            });
        }
    });
});

/*Comment Add*/
$(document).on('submit','form#comment-add',function( event ){
    if (star == '') {
        Swal.fire({
            title: 'Hata !',
            html: 'Yorum Göndermek için Lütfen Yıldız Veriniz.',
            animation: false,
            type: 'error'
        });
    }else{
        event.preventDefault();
        var data = $( this ).serializeArray();
        data.push({name:'star',value:star});
        star = '';
        $.ajax({
            method: 'post',
            dataType: 'json',
            data: data,
            url: site_url+'Ajax/commentAdd',
            success: function(result) {
                if (result.status == true) {
                    $('.product_comment').val('');
                    Swal.fire({
                        title: 'Başarılı!',
                        html: 'Yorumunuz Gönderildi, Onaylandıktan Sonra Yayına Alınacak',
                        type: 'success'
                    });
                } else {
                    Swal.fire({
                        type: 'warning',
                        title: 'Uyarı',
                        html: result.error
                    });
                }
            },
            error: function() {
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    text: 'Bağlantı Hatası !',
                    animation: false,
                    customClass: 'animated tada'
                });
            }
        });   
    }
});

$(document).on('submit','form#question-add',function( event ){
    event.preventDefault();
    var data = $( this ).serializeArray();
    $.ajax({
        method: 'post',
        dataType: 'json',
        data: data,
        url: site_url+'Ajax/questionAdd',
        success: function(result) {
            if (result.status == true) {
                $('.product_question').val('');
                $('.question_category').val(0)
                Swal.fire({
                    title: 'Başarılı!',
                    html: 'Sorunuz Gönderildi, Cevaplandıktan Sonra Yayına Alınacak',
                    type: 'success'
                });
            } else {
                Swal.fire({
                    type: 'warning',
                    title: 'Uyarı',
                    html: result.error
                });
            }
        },
        error: function() {
            Swal.fire({
                type: 'error',
                title: 'Hata !',
                text: 'Bağlantı Hatası !',
                animation: false,
                customClass: 'animated tada'
            });
        }
    });
});

$(document).on('change','.KurumsalAdresCheckbox',function() {
    if (this.checked) {
        $('#firm_name').show();
        $('#tax_no').show();
        $('#tax_admin').show();
    }
});

$(document).on('change','#BireyselAdresCheckbox',function() {
    if (this.checked) {
        $('#firm_name').hide();
        $('#tax_no').hide();
        $('#tax_admin').hide();
    }
});


$(document).on('change','.updateCheck',function() {
    id = $(this).data('id');
    if ($(this).data('type') == 'bireysel') {
        $('#firm_name_'+id).hide();
        $('#tax_no_'+id).hide();
        $('#tax_admin_'+id).hide();
    }else{
        $('#firm_name_'+id).show();
        $('#tax_no_'+id).show();
        $('#tax_admin_'+id).show();
    }
});

/*Register Module*/
$(document).on('click','#register',function() {
    loader();
    var registerInformation = {};
    registerInformation.register_name = $('#register_name').val();
    registerInformation.register_last_name = $('#register_last_name').val();
    registerInformation.register_email = $('#register_email').val();
    registerInformation.register_phone = $('#register_phone').val();
    registerInformation.register_password = $('#register_password').val();
    registerInformation.register_password_again = $('#register_password_again').val();
    registerInformation.membership_agreement = ($('#membership_agreement').is(':checked')) ? 1 : 0;
    registerInformation.campaign_notification = ($('#campaign_notification').is(':checked')) ? 1 : 0;
    if (registerInformation.membership_agreement == 0) {
        $.unblockUI();
        Swal.fire({
            type: 'error',
            title: 'Hata !',
            html: '<p style="text-align:center;">Lütfen Üyelik Sözleşmesini Onaylayın.</p>',
            animation: false,
            customClass: 'animated tada'
        });
    } else {
        $.ajax({
            method: 'post',
            dataType: 'json',
            data: registerInformation,
            url: site_url + 'Ajax/register',
            success: function(result) {
                if (result.status == true) {
                    var r_url = GetURLParameter('redirect');
                    if (r_url == undefined) {
                        window.location = result.redirect_url;
                    }else{
                        window.location = r_url;
                    }
                    $.unblockUI();
                    Swal.fire({
                        type: 'success',
                        title: 'Başarılı !',
                        html: 'Kayıt İşlemi Tamamlandı Yönlendiriliyorsunuz.',
                        animation: false,
                        customClass: 'animated tada'
                    });
                } else {
                    $.unblockUI();
                    Swal.fire({
                        type: 'error',
                        title: 'Hata !',
                        html: result.error,
                        animation: false,
                        customClass: 'animated tada'
                    });
                }
            },
            error: function() {
                $.unblockUI();
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    text: 'Bağlantı Hatası !',
                    animation: false,
                    customClass: 'animated tada'
                });
            }
        });
    }
});

/*Login Module*/
$(document).on('click','#login',function() {
    loader()
    var loginInformation = {};
    loginInformation.login_email = $('#login_email').val();
    loginInformation.login_password = $('#login_password').val();
    loginInformation.remember_me = ($('#remember_me').is(':checked')) ? 1 : 0;
    $.ajax({
        method: 'post',
        dataType: 'json',
        data: loginInformation,
        url: site_url + 'Ajax/login',
        success: function(result) {
            if (result.status == true) {
                var r_url = GetURLParameter('redirect');
                if (r_url == undefined) {
                    window.location = result.redirect_url;
                }else{
                    window.location = r_url;
                }
            } else {
                $.unblockUI();
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    html: result.error,
                    animation: false,
                    customClass: 'animated tada'
                });
            }
        },
        error: function() {
            $.unblockUI();
            Swal.fire({
                type: 'error',
                title: 'Hata !',
                text: 'Bağlantı Hatası !',
                animation: false,
                customClass: 'animated tada'
            });
        }
    });
});

/*Update Account Module*/
$(document).on('click','#updateAccount',function() {
    var updateInformation = {};
    updateInformation.name = $('#name').val();
    updateInformation.surname = $('#surname').val();
    updateInformation.phone = $('#phone').val();
    updateInformation.email = $('#email').val();
    updateInformation.city = $('#city').val();
    updateInformation.town = $('#town').val();
    updateInformation.date_of_birth = $('#date_of_birth').val();
    updateInformation.gender = $('#gender').val();
    $.ajax({
        method: 'post',
        dataType: 'json',
        data: updateInformation,
        url: site_url + 'Ajax/updateAccount',
        success: function(result) {
            if (result.status == true) {
                window.location = result.redirect_url;
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    html: result.error,
                    animation: false,
                    customClass: 'animated tada'
                });
            }
        },
        error: function() {
            Swal.fire({
                type: 'error',
                title: 'Hata !',
                text: 'Bağlantı Hatası !',
                animation: false,
                customClass: 'animated tada'
            });
        }
    });
});

/*Update Account Password*/
$(document).on('click','#updatePassword',function() {
    var updatePasswordInformation = {};
    updatePasswordInformation.currentPassword = $('#currentPassword').val();
    updatePasswordInformation.newPassword = $('#newPassword').val();
    updatePasswordInformation.newPasswordRepeat = $('#newPasswordRepeat').val();
    $.ajax({
        method: 'post',
        dataType: 'json',
        data: updatePasswordInformation,
        url: site_url + 'Ajax/updatePassword',
        success: function(result) {
            if (result.status == true) {
                window.location = result.redirect_url;
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    html: result.error,
                    animation: false,
                    customClass: 'animated tada'
                });
            }
        },
        error: function() {
            Swal.fire({
                type: 'error',
                title: 'Hata !',
                text: 'Bağlantı Hatası !',
                animation: false,
                customClass: 'animated tada'
            });
        }
    });
});

/*Selected Country Value*/
$(document).on('change','#country',function() {
    var CountryID = $('#country').val();
    if (CountryID !== '') {
        $.ajax({
            method: 'post',
            dataType: 'json',
            url: site_url + 'Ajax/getCitiesByCountry/' + CountryID,
            success: function(result) {
                if (result.status) {
                    var html = '';
                    $.each(result.array, function(key, value) {
                        html += '<option value=' + value.CityID + '>' + value.CityName + '</option>';
                    });
                    $('#city').append(html);
                } else {
                    $('#city').html('');
                    $('#city').append('<option value="">Lütfen Seçin</option>');
                    $('#town').html('');
                    $('#town').append('<option value="">Lütfen Seçin</option>');
                }
            },
            error: function() {
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    text: 'Bağlantı Hatası !',
                    animation: false,
                    customClass: 'animated tada'
                });
            }
        });
    } else {
        $('#city').html('');
        $('#city').append('<option value="">Lütfen Seçin</option>');
        $('#town').html('');
        $('#town').append('<option value="">Lütfen Seçin</option>');
    }
});

/*Selected Counties Value*/
$(document).on('change','#city',function() {
    var CityID = $('#city').val();
    if (CityID !== '') {
        $.ajax({
            method: 'post',
            dataType: 'json',
            url: site_url + 'Ajax/getCountiesByCities/' + CityID,
            success: function(result) {
                if (result.status) {
                    $('#town').html('');
                    var html = '';
                    $.each(result.array, function(key, value) {
                        html += '<option value=' + value.CountyID + '>' + value.CountyName + '</option>';
                    });
                    $('#town').append(html);
                } else {
                    $('#town').html('');
                    $('#town').append('<option value="">Lütfen Seçin</option>');
                }
            },
            error: function() {
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    text: 'Bağlantı Hatası !',
                    animation: false,
                    customClass: 'animated tada'
                });
            }
        });
    } else {
        $('#town').html('');
        $('#town').append('<option value="">Lütfen Seçin</option>');
    }
});

/*Selected Counties Value*/
$(document).on('change','#town',function() {
    var AreaID = $('#town').val();
    if (AreaID !== '') {
        $.ajax({
            method: 'post',
            dataType: 'json',
            url: site_url + 'Ajax/getCountiesByArea/' + AreaID,
            success: function(result) {
                if (result.status) {
                    $('#area').html('');
                    var html = '';
                    $.each(result.array, function(key, value) {
                        html += '<option value=' + value.AreaID + '>' + value.AreaName + '</option>';
                    });
                    $('#area').append(html);
                } else {
                    $('#area').html('');
                    $('#area').append('<option value="">Lütfen Seçin</option>');
                }
            },
            error: function() {
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    text: 'Bağlantı Hatası !',
                    animation: false,
                    customClass: 'animated tada'
                });
            }
        });
    }
});

/*Add Address*/
$(document).on('click','#addAddress',function() {
    var addressInformation = {};
    addressInformation.definition = $('#definition').val();
    addressInformation.name = $('#name').val();
    addressInformation.gsm = $('#gsm').val();
    addressInformation.post_code = $('#post_code').val();
    addressInformation.country = $('#country').val();
    addressInformation.city = $('#city').val();
    addressInformation.town = $('#town').val();
    addressInformation.identity_number = $('#identity_number').val();
    addressInformation.content = $('#content').val();
    if ($('#KurumsalAdresCheckbox0').is(':checked')) {
        addressInformation.efatura = ($('#EFaturaAdresCheckbox0').is(':checked')) ? 1 : 0;
        addressInformation.firm_name = $('#firm_name').val();
        addressInformation.tax_no = $('#tax_no').val();
        addressInformation.tax_admin = $('#tax_admin').val();
        addressInformation.corporate = 1;
    }
    $.ajax({
        method: 'post',
        dataType: 'json',
        data: addressInformation,
        url: site_url + 'Ajax/addAddress',
        success: function(result) {
            if (result.status == true) {
                Swal.fire({
                    title: 'Başarılı!',
                    html: 'Adresiniz Sistemimize Eklendi !',
                    type: 'success'
                });
                $('#modalSecondary').trigger('click');
                $('.swal2-confirm').click(function() {
                    window.location.href = result.redirect_url;
                });
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Hata !',
                    html: result.error,
                    animation: false,
                    customClass: 'animated tada'
                });
            }
        },
        error: function() {
            Swal.fire({
                type: 'error',
                title: 'Hata !',
                text: 'Bağlantı Hatası !',
                animation: false,
                customClass: 'animated tada'
            });
        }
    });
});

/*Update Country, City, And Town*/
$(document).on('change','select', function(e) {
    if (window.location.pathname == "/hesabim/adreslerim") {
        var country_id = $(this).attr('id');
        var items = country_id.split('-');
        var CountryID = $('#country-' + items[1]).val();
        if (CountryID !== '') {
            $.ajax({
                method: 'post',
                dataType: 'json',
                url: site_url + 'Ajax/getCitiesByCountry/' + CountryID,
                success: function(result) {
                    if (result.status) {
                        var html = '';
                        $.each(result.array, function(key, value) {
                            html += '<option value=' + value.CityID + '>' + value.CityName + '</option>';
                        });
                        $('#city-' + items[1]).append(html);
                        $('#city-' + items[1]).change(function() {
                            var CityID = $('#city-' + items[1]).val();
                            if (CityID !== '') {
                                $.ajax({
                                    method: 'post',
                                    dataType: 'json',
                                    url: site_url + 'Ajax/getCountiesByCities/' + CityID,
                                    success: function(result) {
                                        if (result.status) {
                                            $('#town-' + items[1]).html('');
                                            var html = '';
                                            $.each(result.array, function(key, value) {
                                                html += '<option value=' + value.CountyID + '>' + value.CountyName + '</option>';
                                            });
                                            $('#town-' + items[1]).append(html);
                                        } else {
                                            $('#town-' + items[1]).html('');
                                            $('#town-' + items[1]).append('<option value="">Lütfen Seçin</option>');
                                        }
                                    },
                                    error: function() {
                                        Swal.fire({
                                            type: 'error',
                                            title: 'Hata !',
                                            text: 'Bağlantı Hatası !',
                                            animation: false,
                                            customClass: 'animated tada'
                                        });
                                    }
                                });
                            } else {
                                $('#town-' + items[1]).html('');
                                $('#town-' + items[1]).append('<option value="">Lütfen Seçin</option>');
                            }
                        });
                    } else {
                        $('#city-' + items[1]).html('');
                        $('#city-' + items[1]).append('<option value="">Lütfen Seçin</option>');
                        $('#town-' + items[1]).html('');
                        $('#town-' + items[1]).append('<option value="">Lütfen Seçin</option>');
                    }
                },
                error: function() {
                    Swal.fire({
                        type: 'error',
                        title: 'Hata !',
                        text: 'Bağlantı Hatası !',
                        animation: false,
                        customClass: 'animated tada'
                    });
                }
            });
        } else {
            $('#city-' + items[1]).html('');
            $('#city-' + items[1]).append('<option value="">Lütfen Seçin</option>');
            $('#town-' + items[1]).html('');
            $('#town-' + items[1]).append('<option value="">Lütfen Seçin</option>');
        }
    }
});

$(document).on('click','.main-nav', function () {
    $('+ .dropdownops', this).slideToggle(280);
    $('> .downarrow', this).toggleClass('arrow-edit');
    $('.filter-span', this).toggleClass('filter-span-edit');
});

$(document).on('click','.main-nav-link', function () {
    $('.filter-span', this).toggleClass('filter-span-dot');
});

var garrageInput = '';
$(document).on('focus','.garageCarInput', function () {
    garrageInput = $(this).val();
});


/* garageCarInput */
$(document).on('focusout','.garageCarInput', function () {
    var data = {};
    data.id = $(this).attr('data-id');
    data.name = $(this).val();
    if (garrageInput != data.name) {
        $.ajax({
            url: site_url + '/Ajax/changeCarNameOnGaragge/',
            method: 'POST',
            dataType: 'JSON',
            data: data,
            success: function (result) {
                if (result.status == 1) {
                    Swal.fire({
                        type: 'success',
                        confirmButtonText: 'Tamam',
                        title: 'İşlem Başarılı',
                        text: 'Araç İsminiz Güncellendi',
                        animation: false,
                        
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        confirmButtonText: 'Tamam',
                        title: 'Hata !',
                        html: result.error,
                        animation: false,
                        
                    });
                }
            },
            error: function (result) {
                Swal.fire({
                    type: 'error',
                    confirmButtonText: 'Tamam',
                    title: 'Hata !',
                    html: 'Üzgünüz Teknik Bir Sorun İle Karşı Karşıyayız',
                    animation: false,
                    
                });
            }
        });
    }
});

$(document).on('click','.filtershow',function () {
    $('.Filter-column').addClass('filtershowon');
    $('.Filter-column').removeClass('filtershowoff');
});

$(document).on('click','.closeFilter',function () {
    $('.Filter-column').addClass('filtershowoff');
    $('.Filter-column').removeClass('filtershowon');
});

$(document).on('click','.toggle-password',function () {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});

/* Scroll Function */
$(document).on('click','#carImageSasi',function () {
    $('div#sasiModal .select-items').animate({
            scrollLeft: $("#engineSelect").offset().left
        },
        'slow');
});

$(document).on('click','button#clearArea',function () {
    cartypeErrors();
    $('#chasisNo').val('');
    $('#carType').val('0');
    $('#carType').trigger('change');
});

/* Listing Filter */
$(document).on('click','.list-head .filter-Btn',function () {
    $('html,body').addClass('FreezeBody');
    $('section.pageContent.ListingPage .Filter-column').addClass('ShowFilter');
});
$(document).on('click','section.pageContent.ListingPage .Filter-column .FilterColumn-Title > .item > .closeFilter,section.pageContent.ListingPage .listing-filter .filter-control > .filter-now',function () {
    $('html,body').removeClass('FreezeBody');
    $('section.pageContent.ListingPage .Filter-column').removeClass('ShowFilter');
});


/* İnsan Kaynakları Photo Change */
$(document).on('change',"#imageUpload",function () {
    readURL(this);
});
/* İK*/

$(document).on('click','.mobileHamburger',function () {
    $('nav.NavMenu, .CloseNav').addClass('Show');
    $('.overlay').addClass('show');
});

$(document).on('click','.soWhat',function () {
    $('div.soWhatOpen').slideToggle(200);
});

$(document).on('click','.CloseNav, .overlay',function () {
    $('nav.NavMenu, .CloseNav').removeClass('Show');
    $('.overlay').removeClass('show');
});

$(document).on('click','#seo-text-show',function () {
    $('#seo-white').toggleClass("areaOpened");
    $('#seo-text-show').toggleClass("Oppa");
});

$(document).on('click','#exmSearch',function () {
    $('#exSearchArea').fadeToggle(500);
});

$(document).on('click','#exSearchClose',function () {
    $('#exSearchArea').fadeToggle(500);
});

$(document).on('click','#mobileSelectBtn',function () {
    $('#mobileSelectBtn').toggleClass('open');
    $('.FormElements').slideToggle(500);
});

$(document).on('click','#toSendReview',function () {
    $([document.documentElement, document.body]).animate({
        scrollTop: $(".RateArea").offset().top
    }, 1000);
});

/* Mob Menu */
$(document).on('click','#hamburger-icon',function () {
    $('.navbar-collapse').addClass('Show');
    $('body, html').addClass('freezePage');
});

$(document).on('click','.Mob-Close',function () {
    $('.navbar-collapse').removeClass('Show');
    $('body, html').removeClass('freezePage');
});

/* File Upload */
$(document).on('change','#carPhotoarea',function () {
    var f = this.files;
    var el = $(this).parent();
    if (f.length > 1) {
        console.log(this.files, 1);
        el.text('Sorry, multiple files are not allowed');
        return;
    }
    el.html(f[0].name + '<br>' +
        '<span class="sml">' +
        'type: ' + f[0].type + ', ' +
        Math.round(f[0].size / 1024) + ' KB</span>');
});

$(document).on('change','#topluteklif',function () {
    var f = this.files;
    var el = $(this).parent();
    if (f.length > 1) {
        console.log(this.files, 1);
        el.text('Sorry, multiple files are not allowed');
        return;
    }
    el.html(f[0].name + '<br>' +
        '<span class="sml">' +
        'type: ' + f[0].type + ', ' +
        Math.round(f[0].size / 1024) + ' KB</span>');
});
/* FAQ */
$(document).on('click','.faqItem',function () {
    $('.faq_Answer').slideUp();
    $('.faqItem').removeClass('Active');
    $(this).addClass('Active');

    if ($(this).hasClass('Active')) {
        $('.faq_Answer', this).slideDown();
    }
});

$(document).on('click','.Layout-4',function () {
    $('.Layout-item').removeClass("Active");
    $(this).addClass("Active");
    $('div').parents('#list-col').attr('class', 'col-6 col-lg-4 col-xl-3');
    $('.list-item').addClass('Small');
});

$(document).on('click','.Layout-Box',function () {
    $('.Layout-item').removeClass("Active");
    $(this).addClass("Active");
    $('div').parents('#list-col').attr('class', 'col-12');
    $('.list-item').removeClass('Small');
});

$(document).on('click','#LangSelect',function () {
    $('.LanguageSelectArea').slideToggle(300);
});

$(document).on('click','#LangSelectm',function () {
    $('.LanguageSelectArea.m').slideToggle(300);
});

$(document).ready(function () {

    $('#dropdownUserOpen').hover(function () {
        $('div.dropdownUserMenu').fadeIn(0);
    }, function () {
        $('div.dropdownUserMenu').fadeOut(0);
    });

    $('#phone').inputmask('9 (999) 999 99 99');
    $('#gsm').inputmask('9 (999) 999 99 99');
    $('#register_phone').inputmask('9 (999) 999 99 99');
    $('#date_of_birth').inputmask('99/99/9999');
    $('#ibanNumber').inputmask('99 9999 9999 9999 9999 99');
    $('#transferPhone').inputmask('9 (999) 999 99 99');
    $('.uGsm').inputmask('9 (999) 999 99 99');
    //$('.plate-input').inputmask('[*]{17}');

    /* Corporate Address */
    $('#firm_name').hide();
    $('#tax_no').hide();
    $('#tax_admin').hide();

    categories = JSON.parse(categories);
    if (categories.length > 0) {
        var values = [];
        $.each(categories, function (key, val) {
            values.push(val.GRUP_ISIM);
            $.each(val.sub, function (key2, val2) {
                $.each(val2.sub, function (key3, val3) {
                    values.push(val3.GRUP_ISIM);
                });
            });
        });

        $(".searchInput").autocomplete({
            minLength: 1,
            autoFocus: false,
            source: [values]
        }).on('selected.xdsoft', function (e, datum) {
            window.location = site_url + 'arama-sonucu?s=' + datum;
            loader();
        });
    }

    var Accordion = function (el, multiple) {
        this.el = el || {};
        this.multiple = multiple || false;
        var links = this.el.find('.link2');
        links.on('click', {
            el: this.el,
            multiple: this.multiple
        }, this.dropdown)
    }

    Accordion.prototype.dropdown = function (e) {
        var $el = e.data.el;
        $this = $(this),
            $next = $this.next();

        $next.slideToggle();
        $this.parent().toggleClass('open');

        if (!e.data.multiple) {
            $el.find('.submenu2').not($next).slideUp().parent().removeClass('open');
        };
    }
    var accordion = new Accordion($('#accordion'), false);

    if ($(window).width() < 1366) {
        $('.container-fluid').addClass('container');
        $('.container').removeClass('container-fluid');
    }

    /* Nav */
    var width = $(window).width();
    if (width < 991) {
        $(document).on('click','nav.NavMenu li h3',function () {
            if ($(this).hasClass('Active')) {
                $('.nav-dropdown').slideUp();
                $(this).removeClass('Active');
                return false;
            }
            $('nav.NavMenu li h3').removeClass('Active');
            $(this).addClass('Active');

            $('.nav-dropdown').slideUp();
            $(this).next('.nav-dropdown').slideDown();
        });

        $(document).on('click','section.pageContent .accountPanel .panel-head',function () {
            if ($(this).hasClass('Active')) {
                $('section.pageContent .accountPanel .panel-content').slideUp();
                $(this).removeClass('Active');
                return false;
            }
            $('section.pageContent .accountPanel .panel-head').removeClass('Active');
            $(this).addClass('Active');

            $('section.pageContent .accountPanel .panel-content').slideUp();
            $(this).next('section.pageContent .accountPanel .panel-content').slideDown();
        });
    }

    /* Footer Accordion */
    if ($(window).width() < 575) {
        $(document).on('click','footer .AccordionFooter', function (event) {
            if ($(this).hasClass('Show')) {
                $(this).removeClass('Show');
                $('footer .Ac-Content').slideUp();
                return false;
            }
            $('footer .AccordionFooter').removeClass('Show');
            $(this).addClass('Show')
            $('footer .Ac-Content').slideUp();
            $(this).next('ul.Ac-Content').slideDown();
        });
    }

    /* Owl */
    $('.owl-slider').owlCarousel({
        loop: true,
        autoplay: false,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        dots: false,
        margin: 0,
        nav: true,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    $('.owl-carBrands').owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: false,
        dots: false,
        margin: 0,
        nav: false,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 4
            },
            1000: {
                items: 8
            }
        }
    });

    $('.owl-banner').owlCarousel({
        animateOut: 'fadeOutLeft',
        animateIn: 'fadeInRight',
        smartSpeed: 300,
        loop: true,
        margin: 0,
        nav: true,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        dots: true,
        autoplay: true,
        autoplayTimeout: 8000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    $('.features-owl').owlCarousel({
        margin: 0,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 3,
            },
            1199: {
                items: 5,
            },
            1366: {
                items: 5,
            },
        }
    });

    $('.testimonial-owl').owlCarousel({
        margin: 20,
        nav: true,
        loop: true,
        dots: false,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 3
            }
        }
    });


    /* Onerlen */
    $('.Onerlen-owl').owlCarousel({
        margin: 20,
        nav: true,
        loop: true,
        dots: false,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    });


    $('.HomeList-owl').owlCarousel({
        margin: 20,
        nav: true,
        loop: true,
        dots: false,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 4
            }
        }
    });

    /* ProductDetail Owl */
    var sync1 = $("#sync1");
    var sync2 = $("#sync2");
    var slidesPerPage = 4;
    var syncedSecondary = true;

    sync1.owlCarousel({
        items: 1,
        slideSpeed: 2000,
        nav: true,
        autoplay: true,
        dots: false,
        loop: true,
        responsiveRefreshRate: 200,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    }).on('changed.owl.carousel', syncPosition);

    sync2
        .on('initialized.owl.carousel', function () {
            sync2.find(".owl-item").eq(0).addClass("current");
        })
        .owlCarousel({
            items: slidesPerPage,
            dots: false,
            nav: false,
            smartSpeed: 200,
            slideSpeed: 500,
            slideBy: slidesPerPage,
            responsiveRefreshRate: 100,
            margin: 10,
            responsive: {
                0: {
                    items: 3,
                },
                575: {
                    items: 4,
                },
                767: {
                    items: 6,
                },
                991: {
                    items: 4,
                },
                1100: {
                    items: 4,
                }
            }
        }).on('changed.owl.carousel', syncPosition2);

    sync2.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = $(this).index();
        sync1.data('owl.carousel').to(number, 300, true);
    });

    $(document).on('focus','#carPhotoarea', function () {
        $(this).parent().addClass('focus');
    });

    $(document).on('blur','#carPhotoarea', function () {
        $(this).parent().removeClass('focus');
    });

    $(document).on('focus','#topluteklif', function () {
        $(this).parent().addClass('focus');
    });

    $(document).on('blur','#topluteklif', function () {
        $(this).parent().removeClass('focus');
    });

    $(".max-75").text(function (index, currentText) {
        return currentText.substr(0, 75) + "..";
    });

    $("section.pageContent.product_Detail .product-tabs .tab_content").hide();
    $("section.pageContent.product_Detail .product-tabs .tab_content:first").show();
    $(document).on('click',"section.pageContent.product_Detail .product-tabs ul.tabs li",function () {
        $("section.pageContent.product_Detail .product-tabs .tab_content").hide();
        var activeTab = $(this).attr("rel");
        $("#" + activeTab).fadeIn();
        $("section.pageContent.product_Detail .product-tabs ul.tabs li").removeClass("active");
        $(this).addClass("active");
    });

    updateToCart();

    if ($('span').hasClass('filter-span-dot')) {
        $('.filter-span-dot').parent().parent().parent().parent().parent().parent().parent().children('.main-nav').trigger('click');
        $('.filter-span-dot').parent().parent().parent().parent().children('.main-nav').trigger('click');
    }

    if (window.location.pathname === "/insankaynaklari") {
        var CityID = $("#city").val();
        if (CityID !== '') {
            $.ajax({
                method: 'post',
                dataType: 'json',
                url: site_url+'Ajax/getCountiesByHumanResources/' + CityID,
                success: function(result){
                    if (result.status) {
                        var html = '';
                        $.each( result.array, function( key, value ) {
                            html += '<option value='+ value.CountyID +'>' + value.CountyName + '</option>';
                        });
                        $('#town').append(html);
                    } else {
                        $('#town').html('');
                        $('#town').append('<option value="">Lütfen Seçin</option>');
                        $('#area').html('');
                        $('#area').append('<option value="">Lütfen Seçin</option>');
                    }
                }, error: function() {
                    Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
                }
            });
        } else {
            $('#town').html('');
            $('#town').append('<option value="">Lütfen Seçin</option>');
            $('#area').html('');
            $('#area').append('<option value="">Lütfen Seçin</option>');
        }
    }


    function syncPosition(el) {
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - (el.item.count / 2) - .5);

        if (current < 0) {
            current = count;
        }
        if (current > count) {
            current = 0;
        }

        sync2
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
        var onscreen = sync2.find('.owl-item.active').length - 1;
        var start = sync2.find('.owl-item.active').first().index();
        var end = sync2.find('.owl-item.active').last().index();

        if (current > end) {
            sync2.data('owl.carousel').to(current, 100, true);
        }
        if (current < start) {
            sync2.data('owl.carousel').to(current - onscreen, 100, true);
        }
    }

    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            sync1.data('owl.carousel').to(number, 100, true);
        }
    }

    /* Yıldız üzerine gelince yanma olayı */
    $('#stars li').on('mouseover', function () {
        var onStar = parseInt($(this).data('value'), 10);

        $(this).parent().children('li.star').each(function (e) {
            if (e < onStar) {
                $(this).addClass('hover');
            } else {
                $(this).removeClass('hover');
            }
        });

    }).on('mouseout', function () {
        $(this).parent().children('li.star').each(function (e) {
            $(this).removeClass('hover');
        });
    });

    $('#stars li').on('click', function () {
        var onStar = parseInt($(this).data('value'), 10);
        var stars = $(this).parent().children('li.star');

        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }

        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }

        var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
        var msg = "";
        if (ratingValue > 1) {
            msg = "Bize<b> " + ratingValue + "</b> yıldız verdiniz. Teşekkürler !";
        } else {
            msg = "Kendimizi geliştireceğiz..";
        }
        responseMessage(msg);

    });
});