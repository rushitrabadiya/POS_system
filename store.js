src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"

if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
} else {
    ready()
}

function ready() {
    var removeCartItemButtons = document.getElementsByClassName('btn-remove')
    for (var i = 0; i < removeCartItemButtons.length; i++) {
        var button = removeCartItemButtons[i]
        button.addEventListener('click', removeCartItem)
    }

    var quantityInputs = document.getElementsByClassName('cart-quantity-input')
    for (var i = 0; i < quantityInputs.length; i++) {
        var input = quantityInputs[i]
        input.addEventListener('change', quantityChanged)
    }

    var addToCartButtons = document.getElementsByClassName('shop-item-button')
    for (var i = 0; i < addToCartButtons.length; i++) {
        var button = addToCartButtons[i]
        button.addEventListener('click', addToCartClicked)
    }

    var dropdown = document.getElementsByClassName('custom-slect')
    for(var i=0;i<dropdown.length;i++){
        var select = dropdown[i]
        select.addEventListener('click', changeprice)
    }

    var changeprice = document.getElementsByClassName('size-select-s')
    for (var i = 0; i < changeprice.length; i++) {
        var button = changeprice[i]
        button.addEventListener('click', selectPrices)
    }

    var changeprice1 = document.getElementsByClassName('size-select-m')
    for (var i = 0; i < changeprice1.length; i++) {
        var button = changeprice1[i]
        button.addEventListener('click', selectPricem)
    }

    var changeprice2 = document.getElementsByClassName('size-select-l')
    for (var i = 0; i < changeprice2.length; i++) {
        var button = changeprice2[i]
        button.addEventListener('click', selectPricel)
    }

    // document.getElementsByClassName('btn-purchase1')[0].addEventListener('click', purchaseClicked)

    document.getElementsByClassName('btn-clear1')[0].addEventListener('click', clearCart)
    
    console.log(document.cookie)
    if(document.cookie!=0){
        var cookie = document.cookie.split(";")
        for(i=0;i<cookie.length;i++){
            var cookiepair = cookie[i].split("=")
            console.log(cookiepair[0])
            if(cookiepair[1]!="" && cookiepair[0]!="PHPSESSID"){
                cookiel = cookiepair[1].split(",")
                addItemToCart(cookiepair[0], cookiel[0], cookiel[1], cookiel[2])
                updateCartTotal()
            }
        }
    }
}

function selectPrices(event) {
    var button = event.target
    var shopItem = button.parentElement.parentElement.parentElement
    var title = shopItem.getElementsByClassName('shop-item-title')[0].innerText;
    var l = title.length;
    title = title.substring(0,l-2);
    shopItem.getElementsByClassName('shop-item-title')[0].innerText = title+"-S";
    var price = parseFloat(shopItem.getElementsByClassName('hide-price')[0].innerText);
    shopItem.getElementsByClassName('shop-item-price')[0].innerText = price-(price*0.2)
}

function selectPricem(event) {
    var button = event.target
    var shopItem = button.parentElement.parentElement.parentElement
    var title = shopItem.getElementsByClassName('shop-item-title')[0].innerText;
    var l = title.length;
    title = title.substring(0,l-2);
    shopItem.getElementsByClassName('shop-item-title')[0].innerText = title+"-M";
    var price = parseFloat(shopItem.getElementsByClassName('hide-price')[0].innerText);
    shopItem.getElementsByClassName('shop-item-price')[0].innerText = price
}

function selectPricel(event) {
    var button = event.target
    var shopItem = button.parentElement.parentElement.parentElement
    var title = shopItem.getElementsByClassName('shop-item-title')[0].innerText;
    var l = title.length;
    title = title.substring(0,l-2);
    shopItem.getElementsByClassName('shop-item-title')[0].innerText = title+"-L";
    var price = parseFloat(shopItem.getElementsByClassName('hide-price')[0].innerText);
    shopItem.getElementsByClassName('shop-item-price')[0].innerText = (price+(price*0.2))
}

function purchaseClicked() {
    alert('Thank you for your purchase')
    var cartItems = document.getElementsByClassName('cart-items')[0]
    while (cartItems.hasChildNodes()) {
        cartItems.removeChild(cartItems.firstChild)
    }
    updateCartTotal()
}

function clearCart() {
    var cartItems = document.getElementsByClassName('cart-items')[0]
    while (cartItems.hasChildNodes()) {
        cartItems.removeChild(cartItems.firstChild)
    }
    if(document.cookie!=0){
        var cookie = document.cookie.split(";")
        for(i=0;i<cookie.length;i++){
            var cookiepair = cookie[i].split("=")
            if(cookiepair[0]!="PHPSESSID")
                document.cookie = cookiepair[0] + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
        }
    }
    updateCartTotal()
}

function removeCartItem(event) {
    var buttonClicked = event.target
    var title = buttonClicked.parentElement.parentElement.parentElement.getElementsByClassName('cart-item-title')[0].innerText
    document.cookie = title + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
    buttonClicked.parentElement.parentElement.parentElement.remove()
    updateCartTotal()
}

function quantityChanged(event) {
    var input = event.target
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1
    }
    var title = input.parentElement.parentElement.parentElement.getElementsByClassName('cart-item-title')[0].innerText;
    var cookie = document.cookie.split(";")
    for(i=0;i<cookie.length;i++){
        var cookiepair = cookie[i].split("=")
        title = title.trim()
        cookiepair[0] = cookiepair[0].trim()
        if(cookiepair[0]==title){
            var change = "," + input.value;
            var cool = cookiepair[1].split(",")
            var ori = "," + cool[2];
            console.log(change,ori)
            var value = cookiepair[1].replace(ori,change)
            document.cookie = title + "=" + value + "; path=/";
        }
    }
    updateCartTotal()
}

function addToCartClicked(event) {
    var button = event.target
    var shopItem = button.parentElement.parentElement
    var title = shopItem.getElementsByClassName('shop-item-title')[0].innerText
    var price = shopItem.getElementsByClassName('shop-item-price')[0].innerText
    var imageSrc = shopItem.getElementsByClassName('shop-item-image')[0].src
    addItemToCart(title, price, imageSrc)
    updateCartTotal()
}

function addItemToCart(title, price, imageSrc, quantity = 1) {
    var cartRow = document.createElement('div')
    cartRow.classList.add('cart-row')
    var cartItems = document.getElementsByClassName('cart-items')[0]
    var cartItemNames = cartItems.getElementsByClassName('cart-item-title')
    for (var i = 0; i < cartItemNames.length; i++) {
        if (cartItemNames[i].innerText == title) {
            alert('This item is already added to the cart')
            return
        }
    }
    var cartRowContents = `
        <div class="cart-item cart-column">
            <img class="cart-item-image" src="${imageSrc}" width="25" height="25">
            <span><span class="cart-item-title">${title}</span>
            <span><textarea cols="5" rows="1" placeholder="notes"></textarea></span></span>
        </div>
        <span class="cart-price cart-column"> Rs  ${price}</span>
        <div class="cart-quantity cart-column">
            <input class="cart-quantity-input" type="number" value="${quantity}">
            <button class="btn-remove"><i class="fas fa-duotone fa-trash" style="color: red; width: 25px; height: 25px;"></i></button>
        </div>`
    cartRow.innerHTML = cartRowContents
    cartItems.append(cartRow)
    cartRow.getElementsByClassName('btn-remove')[0].addEventListener('click', removeCartItem)
    cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change', quantityChanged)
    setCookie(title,price,imageSrc,quantity)
}

function setCookie(title, price, imageSrc, quantity = 1) {
    var cookiec = title + "=" + price + "," + imageSrc + "," + quantity + "; path=/";
    document.cookie = cookiec
}

function updateCartTotal() {
    var cartItemContainer = document.getElementsByClassName('cart-items')[0]
    var cartRows = cartItemContainer.getElementsByClassName('cart-row')
    var total = 0
    var totalitems = 0
    for (var i = 0; i < cartRows.length; i++) {
        var cartRow = cartRows[i]
        var priceElement = cartRow.getElementsByClassName('cart-price')[0]
        var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0]
        var price = parseFloat(priceElement.innerText.replace('Rs ', ''))
        var quantity = quantityElement.value
        total = total + (price * quantity)
        totalitems = totalitems + parseInt(quantity)
    }
    total = Math.round(total * 100) / 100
    document.getElementsByClassName('total-items-value')[0].innerText = totalitems
    document.getElementsByClassName('cart-total-price')[0].innerText = 'Rs ' + total
}


const forms = document.querySelector(".box2"),
    pwShowHide = document.querySelectorAll(".eye-icon");

pwShowHide.forEach(eyeIcon => {
    eyeIcon.addEventListener("click", () => {
        let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");
        pwFields.forEach(password => {
            if(password.type === "password"){
                password.type = "text";
                eyeIcon.classList.replace("bx-hide", "bx-show");
                return;
            }
      password.type = "password";
      eyeIcon.classList.replace("bx-show", "bx-hide");
  })
  
})
})  

const stripe = Stripe("pk_test_51MoHmPSJKkdwyKwtGtpXGh13Nf6dB5imM5XmPQwMfmz5cFwzEiqmsZkBJRBkkXI89TYNXJQP9aHwwmnZWGElZR7x00uHuPgxpU")
const btn = document.querySelector('#btn')
btn.addEventListener('click', ()=>{
    fetch('/checkout.php',{
        method:"POST",
        headers:{
            'Content-Type' : 'application/json',
        },
        body: JSON.stringify({})
    }).then(res=> res.json())
    .then(payload => {
        stripe.redirectToCheckout({sessionId: payload.id})
    })
})