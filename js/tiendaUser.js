//LOGIN Y REGISTER
const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const btnPopup = document.querySelector('.btnLogin-popup');
const iconClose = document.querySelector('.icon-close');
const btnfondo = document.querySelector(".btnfondo");
const olvideContra = document.getElementById('olvideContra');
const loginOlvideContra = document.getElementById('loginOlvideContra');

registerLink?.addEventListener('click', ()=> {
    wrapper.classList.add('active');
});

loginLink?.addEventListener('click', ()=> {
    wrapper.classList.remove('active');
});

btnPopup?.addEventListener('click', ()=> {
    wrapper.classList.add('active-popup');
    btnfondo.style.display = "block";
});

iconClose?.addEventListener('click', ()=> {
    wrapper.classList.remove('active-popup');
    wrapper.classList.remove('activeContra');
    btnfondo.style.display = "none";
    errorFondo.style.display = "none";
});

olvideContra?.addEventListener('click', ()=>{
    wrapper.classList.add('activeContra');
});

loginOlvideContra?.addEventListener('click', ()=>{
    wrapper.classList.remove('activeContra');
})

// CATEGORIA

let listElements = document.querySelectorAll('.contenedor-cat--click');
const flecha = document.querySelector('.flecha-icon');

listElements.forEach(listElement => {
    listElement.addEventListener('click', ()=>{
        listElement.classList.toggle('flecha-icon--click');
        
        let height = 0;
        let menu = listElement.nextElementSibling;

        if(menu.clientHeight == "10"){
            height = menu.scrollHeight;
        }

        menu.style.height = `${height}px`;

    })
});

//CARRITO DE COMPRAS

const contenedorCarrito = document.querySelector('.contenedor__carrito');
const contenedorCarritoModal = document.querySelector('.contenedor__carrito__modal');
const containerCarrito = document.querySelector('.carrito__modal__on');

if(contenedorCarrito != null){
    contenedorCarrito.addEventListener('click', ()=>{
        contenedorCarritoModal.classList.toggle('carrito__modal__on');
    });
}

// USER

const nameUser = document.querySelector('.contenedor__perfil__info--user');
const logOut = document.querySelector('.contenedor__perfil__info--logout');
const main = document.querySelector('.mainClass');
const flechitaUser = document.querySelector('.flechitaUser');

if(nameUser != null){
    nameUser.addEventListener('click', ()=> {
        logOut.classList.toggle('on');
        flechitaUser.classList.toggle('flechitaUserRotate');
    });
}
main?.addEventListener('click', ()=> {
    logOut.classList.remove('on');
    flechitaUser.classList.remove('flechitaUserRotate');
});

// LOGOUT

const cerrarSesion = document.getElementById('logOut');
const sesionContainer = document.querySelector('.cerrar__sesion--container');
const fondoSesion = document.querySelector('.cerrar__sesion--fondo');
const iconoCerrarSesion = document.querySelector('.cerrar__sesion-close');
const noCerrar = document.getElementById('cerrarSesionNo');
const cerrarSesionH1 = document.getElementById('cerrarSesion');


if(cerrarSesion != null){
    cerrarSesion.addEventListener('click', ()=> {
        sesionContainer.style.display = "flex";
        fondoSesion.style.display = "block";
    });
}
iconoCerrarSesion?.addEventListener('click', ()=>{
    sesionContainer.style.display = "none";
    fondoSesion.style.display = "none";
});

noCerrar?.addEventListener('click', ()=>{
    sesionContainer.style.display = "none";
    fondoSesion.style.display = "none";
});

if(cerrarSesionH1 != null){
cerrarSesionH1.addEventListener('click', ()=> {
    sesionContainer.style.display = "flex";
    fondoSesion.style.display = "block";
});
}

//SOLAPA CONFIG USER, CAMBIAR CONTRA...

const misCompras = document.getElementById('misCompras');

const containerCompras = document.querySelector('.container__todo__compras__sub');
const containerConfigUser = document.querySelectorAll('.container__sub__2');
const infoUser = document.getElementById('infoUser');
const cambiarClave = document.getElementById('cambiarClave');
const containerCambiarClave = document.querySelector('.container__todo_cambiarClave__sub');
const datos = document.querySelector('.container__sub__2--datos');

if(misCompras != null){
    misCompras.addEventListener('click', ()=>{
        containerCompras.style.display = "flex";
        containerConfigUser.forEach(containerConfig => {
            containerConfig.style.display = "none";
        });
        containerCambiarClave.style.display = "none";
        datos.style.display = "none";
})
}

if(infoUser != null){
    infoUser.addEventListener('click', ()=>{
        containerCompras.style.display = "none";
        containerCambiarClave.style.display = "none";
        containerConfigUser.forEach(containerConfig => {
            containerConfig.style.display = "flex";
        });
        datos.style.display = "block";
});
}

if(cambiarClave != null){
    cambiarClave.addEventListener('click', ()=>{
        containerConfigUser.forEach(containerConfig => {
            containerConfig.style.display = "none";
        });
        containerCompras.style.display = "none";
        containerCambiarClave.style.display = "flex";
        datos.style.display = "none";
    });
}

//GRID Y LISTA

const grid = document.getElementById('grid');
const list = document.getElementById('list');
const containerGrid = document.querySelector('.container-items');
const containerBuscadorGrilla = document.querySelector('.container__buscador__grilla');
const infoPrd = document.querySelectorAll('.info-producto');
const items = document.querySelectorAll('.item');
const figures = document.querySelectorAll('figure');
const submits = document.querySelectorAll('.info-producto-submit');
const contactos = document.querySelectorAll('.item__contacto');
const paginacion = document.querySelector('.container__todo__paginacion');
const containerSinResultados = document.querySelector('.container__todo__sinResultados');

if(grid != null){
    grid.addEventListener('click', ()=>{

        containerGrid.classList.add('container-items-grilla');
        containerBuscadorGrilla.classList.add('container__buscador__grilla-grilla');
        paginacion.classList.add('paginacion-grid');
        if(containerSinResultados != null){
            containerSinResultados.classList.add('sinResultadosGrid');
        }
        items.forEach(item => {
            item.classList.add('item-grilla');
        });

        infoPrd.forEach(infoPr => {
            infoPr.classList.add('info-producto-grilla');
        });

        figures.forEach(figure => {
            figure.classList.add('figure-grilla');
        });

        submits.forEach(submit => {
            submit.classList.add('info-producto-submit-grilla');
        });

        contactos.forEach(contacto => {
            contacto.classList.add('item__contacto-grilla');
        });

    });
}

if(list != null){
    list.addEventListener('click', ()=>{
        
        containerGrid.classList.remove('container-items-grilla');
        containerBuscadorGrilla.classList.remove('container__buscador__grilla-grilla');
        paginacion.classList.remove('paginacion-grid');
        if(containerSinResultados != null){
            containerSinResultados.classList.remove('sinResultadosGrid');
        }

        items.forEach(item => {
            item.classList.remove('item-grilla');
        });

        infoPrd.forEach(infoPr => {
            infoPr.classList.remove('info-producto-grilla');
        });

        figures.forEach(figure => {
            figure.classList.remove('figure-grilla');
        });

        submits.forEach(submit => {
            submit.classList.remove('info-producto-submit-grilla');
        });

        contactos.forEach(contacto => {
            contacto.classList.remove('item__contacto-grilla');
        });

    });
} 


//VALIDACION DE FORM CAMBIAR CLAVE

const formCambiarClave = document.querySelector('.container__todo_cambiarClave__sub');
const contraActual = document.getElementById('contraActual');
const contraNueva = document.getElementById('contraNueva');
const contraRepetir = document.getElementById('contraRepetir');
const msjClave = document.getElementById('msjClave');
const msjClaveNueva = document.getElementById('msjClaveNueva');
const msjClaveRepetir = document.getElementById('msjClaveRepetir');

if( formCambiarClave != null ){
    formCambiarClave.addEventListener('submit', validarForm);
    function validarForm( evento ){
        let flag = true;
        evento.preventDefault();
        msjClave.style.display = 'none';
        if( checkVacio( contraActual ) ){
            msjClave.style.display = 'block';
            flag = false;
        }
        msjClaveNueva.style.display = 'none';
        if( checkVacio( contraNueva ) ){
            msjClaveNueva.style.display = 'block';
            flag = false;
        }
        msjClaveRepetir.style.display = 'none';
        if( checkVacio( contraRepetir ) ){
            msjClaveRepetir.style.display = 'block';
            flag = false;
        }
        if( checkRepite() ){
            msjClaveRepetir.style.display = 'block';
            flag = false;
        }
        if( flag ){
            formCambiarClave.submit();
        }
    }

    function checkVacio(campo)
    {
        if( campo.value == '' || campo.value == null ){
            return true;
        }
        return false;
    }
    function checkRepite()
    {
        if( contraNueva.value != contraRepetir.value ){
            //console.log('no coinciden');
            return true;
        }
        return false;
    }
}
//CAMBIO DE CLAVE ERRONEO

const cerrarCambioClaveError = document.querySelector('.error__cambioClave-close');
const cambioClaveFondo = document.querySelector('.error__cambioClave--fondo');
const containerErrorCambioClave = document.querySelector('.error__cambioClave--container');
const cambioClaveIntentarNuevamente = document.querySelector('.error__cambioClave-intentarDeNuevo');

if(cerrarCambioClaveError != null){
    cerrarCambioClaveError.addEventListener('click', ()=>{
        cambioClaveFondo.style.display = "none";
        containerErrorCambioClave.style.display = "none";
    });
}

if(cambioClaveIntentarNuevamente != null){
    cambioClaveIntentarNuevamente.addEventListener('click', ()=>{
        cambioClaveFondo.style.display = "none";
        containerErrorCambioClave.style.display = "none";
        containerConfigUser.style.display = "none";
        containerCompras.style.display = "none";
        containerCambiarClave.style.display = "flex";
    });
}

// CARRITO COMPRAS SIGUIENTE

const containerTimelapseProductos = document.querySelector('.container__timelapse__productos');
const prdH2 = document.querySelector('.prdH2');
const containerTimelapseEnvio = document.querySelector('.container__timelapse__envio');
const enviodH2 = document.querySelector('.enviodH2');
const containerTimelapsePago = document.querySelector('.container__timelapse__pago');
const pagoH2 = document.querySelector('.pagoH2');
const containerTimelapseConfCompra = document.querySelector('.container__timelapse__confirmarCompra');
const confH2 = document.querySelector('.confH2');
const contadorSiguiente = document.getElementById('contadorSiguiente');
const contadorSiguienteInput = document.getElementById('contadorSiguienteInput');
const containerModalPrd = document.querySelectorAll('.containerModal__carrito');
const containerCarritoEnvios = document.querySelector('.contenedor__carrito__modal__envios');
const anterior = document.getElementById('anterior');
const tituloCarrito = document.getElementById('tituloCarrito');
const contenedorAndreani = document.querySelector('.contenedor__carrito__modal__transportes--andreani-img');
const contenedorOca = document.querySelector('.contenedor__carrito__modal__transportes--oca-img');
const transporteAndreani = document.getElementById('andreani');
const transporteOca = document.getElementById('oca');
const containerInfoUserEnvios = document.querySelectorAll('.container__sub__2');
const siguientePost = document.getElementById('siguientePost');
const totalCompra = document.getElementById('TOTAL');
const errorIconClose = document.querySelector('.error__icon-close');
const errorFondo = document.querySelector('.errorFondo');
const error = document.querySelector('.error');
const infoRecepEnvio = document.querySelector('.container__infoReceptorEnvio');
const precioAndreani = document.getElementById('precioAndreani');
const precioOca = document.getElementById('precioOca');

if(errorIconClose != null){
    errorIconClose.addEventListener('click', ()=>{
        errorFondo.style.display = "none";
        error.style.display = "none";
    });
}

if(contenedorAndreani != null){
    contenedorAndreani.addEventListener('click', ()=>{
        transporteAndreani.checked = true;
        contenedorAndreani.style.border = "4px solid green";
        contenedorOca.style.border = "2px solid #bbb";
        precioOca.style.opacity = "0";
        precioAndreani.style.opacity = "100%";
    });
}

if(contenedorOca != null){
    contenedorOca.addEventListener('click', ()=>{
        transporteOca.checked = true;
        contenedorOca.style.border = "4px solid green";
        contenedorAndreani.style.border = "2px solid #bbb";
        precioAndreani.style.opacity = "0";
        precioOca.style.opacity = "100%";
    })
}


var contador = 0;
if(contadorSiguiente != null){
    contadorSiguiente.addEventListener('click', ()=>{
        contador++;
        console.log(contador);
        if(contador == 1){
            containerModalPrd.forEach(containerModalPr => {
                containerModalPr.style.display = "none";
            });
            containerInfoUserEnvios.forEach(infoUserEnvios =>{
                infoUserEnvios.style.display = "flex";
            });
            contadorSiguiente.style.display = "none";
            contadorSiguienteInput.style.display = "block";
            prdH2.style.opacity = "50%";
            enviodH2.style.opacity = "100%";
            totalCompra.style.display = "none";
            containerCarritoEnvios.style.display = "flex";
            anterior.style.display = "flex";
            tituloCarrito.style.display = "none";
            infoRecepEnvio.style.display = "flex";
        }else if(contador == 2){
            contador = 1;
        }
    }); 
}

if(anterior != null){
    anterior.addEventListener('click', ()=>{
        contador--;
        if(contador == 0){
            containerModalPrd.forEach(containerModalPr => {
                containerModalPr.style.display = "flex";
            });
            prdH2.style.opacity = "100%";
            enviodH2.style.opacity = "50%";
            containerCarritoEnvios.style.display = "none";
            anterior.style.display = "none";
            tituloCarrito.style.display = "block";
            contadorSiguiente.style.display = "block";
            contadorSiguienteInput.style.display = "none";
            infoRecepEnvio.style.display = "none";
        }
    });
}
//FORMA DE PAGO CARRITO DE COMPRAS

const contenedorPaypal = document.querySelector('.container__todo__mediosPago--sub.paypal');
const contenedorMercadopago = document.querySelector('.container__todo__mediosPago--sub.mercadopago');
const contenedorBanco = document.querySelector('.container__todo__mediosPago--sub.banco');
const paypal = document.getElementById('paypal');
const mercadopago = document.getElementById('mercadopago');
const banco = document.getElementById('banco');

if(contenedorPaypal != null){
    contenedorPaypal.addEventListener('click', ()=>{
        paypal.checked = true;
        contenedorPaypal.style.border = "4px solid rgb(33, 158, 100)";
        contenedorMercadopago.style.border = "2px solid #000";
        contenedorBanco.style.border = "2px solid #000";
    });
}

if(contenedorMercadopago != null){
    contenedorMercadopago.addEventListener('click', ()=>{
        mercadopago.checked = true;
        contenedorMercadopago.style.border = "4px solid rgb(33, 158, 100)";
        contenedorPaypal.style.border = "2px solid #000";
        contenedorBanco.style.border = "2px solid #000";
    });
}

if(contenedorBanco != null){
    contenedorBanco.addEventListener('click', ()=>{
        banco.checked = true;
        contenedorBanco.style.border = "4px solid rgb(33, 158, 100)";
        contenedorPaypal.style.border = "2px solid #000";
        contenedorMercadopago.style.border = "2px solid #000";
    });
}

//VALIDACION INPUT CELULAR

let celular = document.getElementById('celular');

celular?.addEventListener('keypress', (event) => {
    event.preventDefault();
    let codigoKey = event.keyCode;
    console.log(codigoKey);
    let valorKey = String.fromCharCode(codigoKey);
    console.log(valorKey);

    let valor = parseInt(valorKey);
    console.log(valor);

    if(valor) {
        celular.value += valor
    } else if (valor || valorKey === "0") { 
        (celular.value += valor);
    }
})

// GRID

// const productos = [
//     {
//         id: 1,
//         productName: "PC Gamer AMD Ryzen 5 5600G 16GB DDR4 SSD 240GB",
//         price: 220000,
//         quanty: 1,
//         img: "http://localhost/RC/ATHLON%203000G%20AUREOX%20YI%20GALAXY.png",
//         stock: 2
//     },
//     {
//         id: 2,
//         productName: "PC Escritorio I5 9400 8GB DDR4 SSD 240GB",
//         price: 120000,
//         quanty: 1,
//         img: "http://localhost/RC/ATHLON%203000G%20GABINETE%20RAYZEN%20KRATOS.png",
//         stock: 0
//     },
//     {
//         id: 3,
//         productName: "PC Gamer Celeron G6900G 8GB DDR4 SSD 240GB",
//         price: 180000,
//         quanty: 1,
//         img: "http://localhost/RC/CELERON%20%20GT%201030%20y%20235GM.png",
//         stock: 1
//     },
// ];

// const cart = []

// const shopContent = document.getElementById("shopContent");
// const itemContent = document.getElementById("itemContent");

// productos.forEach((product)=>{
//     const item = document.createElement("div");
//     item.className = "item";
//     shopContent.append(item);

//     const imgProd = document.createElement("figure");
//     imgProd.innerHTML = `
//     <img src="${product.img}">
//     `;
//     item.append(imgProd);

//     const infoProd = document.createElement("div");
//     infoProd.className = "info-producto"
//     infoProd.innerHTML = `
//     <h3>${product.productName}</h3>
//     <p class="precio">${product.price} $</p>
//     <p class="stock" id="stock">Stock: ${product.stock}</p>
//     `;
//     item.append(infoProd);

//     const buyButton = document.createElement("button");
//     buyButton.innerText = "AGREGAR AL CARRITO"
//     infoProd.append(buyButton);

//     if (product.stock === 0) {
//         buyButton.innerText = "SIN STOCK";
//         buyButton.disabled = true;
//     };


//     buyButton.addEventListener("click", ()=>{
//         const repeat = cart.some((repeatProduct) => repeatProduct.id == product.id);

//         if(repeat){
//             cart.map((prod)=>{
//                 if(prod.id === product.id){
//                     prod.quanty++;
//                     displayCartCounter();
//                 }
//             })
//         } else { 
//         cart.push({
//             id: product.id,
//             productName: product.productName,
//             price: product.price,
//             quanty: product.quanty,
//             img: product.img,
//         });
//         displayCartCounter();
//     }
//     })
// });

// // CARRITO

// const modalContainer = document.getElementById("modal-container");
// const modalOverlay = document.getElementById("modal-overlay");
// const cartBtn = document.getElementById("cart-btn");
// const cartCounter = document.getElementById("cart-counter");

// const displayCart = () => {
//     modalContainer.innerHTML = "";
//     modalContainer.style.display = "block";
//     modalOverlay.style.display = "block";
//     //modal header
//     const modalHeader = document.createElement("div");

//     const modalClose = document.createElement("div");
//     modalClose.innerText = "❌"
//     modalClose.className = "modal-close";
//     modalHeader.append(modalClose);

//     modalClose.addEventListener("click", ()=>{
//         modalContainer.style.display = "none";
//         modalOverlay.style.display = "none";
//     })

//     const modalTitle = document.createElement("div");
//     modalTitle.innerText = "Cart";
//     modalTitle.className = "modal-title";
//     modalHeader.append(modalTitle);

//     modalContainer.append(modalHeader);

//     //modal body
//     if(cart.length > 0){
//     cart.forEach((product) => {
//         const modalBody = document.createElement("div");
//         modalBody.className = "modal-body";
//         modalBody.innerHTML = `
//         <div class="product">
//             <img class="product-img" src="${product.img}"/>
//             <div class="product-info">
//                 <h4>${product.productName}</h4>
//             </div>
//             <div class="quantity">
//                 <span class="quantity-btn-decrese">-</span>
//                 <span class="quantity-input">${product.quanty}</span>
//                 <span class="quantity-btn-increase">+</span>
//             </div>
//                 <div class="price">${product.price * product.quanty} $</div>
//                 <div class="delete-product">❌</div>
//         </div>
//         `;
//         modalContainer.append(modalBody);

//         const decrease = modalBody.querySelector(".quantity-btn-decrese");
//         decrease.addEventListener("click", ()=>{
//             if(product.quanty !=1){
//             product.quanty--;
//             displayCart();
//             displayCartCounter();
//             }
//         })

//         const increase = modalBody.querySelector(".quantity-btn-increase");
//         increase.addEventListener("click", ()=>{
//             product.quanty++;
//             displayCart();
//             displayCartCounter();
//         });

//         //delete
//         const deleteProduct = modalBody.querySelector(".delete-product");
//         deleteProduct.addEventListener("click", ()=>{
//             deleteCartProduct(product.id);
//             displayCartCounter();
//         })
//     });

//     //modal footer
//     const total = cart.reduce((acc, el) => acc + el.price * el.quanty, 0);

//     const modalFooter = document.createElement("div");
//     modalFooter.className = "modal-footer";
//     modalFooter.innerHTML = `
//     <div class="total-price">TOTAL: $${total}</div>
//     `;
//     modalContainer.append(modalFooter);
// }else {
//     const modalText = document.createElement("h2");
//     modalText.className = "modal-body";
//     modalText.innerText = "TU CARRITO ESTA VACIO";
//     modalContainer.append(modalText);
// }
// }

// cartBtn.addEventListener("click", displayCart);

// const deleteCartProduct = (id) => {
//     const foundId = cart.findIndex((element)=> element.id === id);
//     cart.splice(foundId, 1);
//     displayCart();
//     displayCartCounter();
// }

// const displayCartCounter = ()=> {
//     const cartLength = cart.reduce((acc, el) => acc + el.quanty, 0);
//     cartCounter.innerText = cartLength;
// }