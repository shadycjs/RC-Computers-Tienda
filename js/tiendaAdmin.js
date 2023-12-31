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