let modalQt = 1;
let cart = [];
let modalKey = 0;
let tamPizzaNome;
const q = (el) => document.querySelector(el);
const qA = (el) => document.querySelectorAll(el);



//Listagem das Pizzas
pizzaJson.map((pizza, index) => {
    let pizzaItem = q('.models .pizza-item').cloneNode(true);

    pizzaItem.setAttribute('data-key', index);
    pizzaItem.querySelector('.pizza-item--img img').src = pizza.img;
    pizzaItem.querySelector('.pizza-item--price').innerHTML = `R$ ${pizza.price.toFixed(2)}`;
    pizzaItem.querySelector('.pizza-item--name').innerHTML = pizza.name;
    pizzaItem.querySelector('.pizza-item--desc').innerHTML = pizza.description;

    pizzaItem.querySelector('a').addEventListener('click', (e) => {
        e.preventDefault();
        let key = e.target.closest('.pizza-item').getAttribute('data-key');
        modalQt = 1;
        modalKey = key;

        q('.pizzaInfo h1').innerHTML = pizzaJson[key].name;
        q('.pizzaInfo--desc').innerHTML = pizzaJson[key].description;
        q('.pizzaBig img').src = pizzaJson[key].img;
        q('.pizzaInfo--size.selected').classList.remove('selected')

        qA('.pizzaInfo--size').forEach((tam, tamIndex) => {
            if (tamIndex == 2) {
                tam.classList.add('selected')
            }
            tam.querySelector('span').innerHTML = pizzaJson[key].sizes[tamIndex]
        });

        q('.pizzaInfo--qt').innerHTML = modalQt;

        q('.pizzaInfo--actualPrice').innerHTML = `R$ ${pizzaJson[key].price.toFixed(2)}`;
        q('.pizzaWindowArea').style.opacity = 0;
        q('.pizzaWindowArea').style.display = 'flex';
        setTimeout(() => {
            q('.pizzaWindowArea').style.opacity = 1;
        }, 500);
    })
    q('.pizza-area').append(pizzaItem);
});

//Eventos do Modal
function fecharModal() {
    q('.pizzaWindowArea').style.opacity = 0;
    setTimeout(() => {
        q('.pizzaWindowArea').style.display = 'none';
    }, 200);
}
qA('.pizzaInfo--cancelButton, .pizzaInfo--cancelMobileButton').forEach((item) => {
    item.addEventListener('click', fecharModal)
});
q('.pizzaInfo--qtmenos').addEventListener('click', () => {
    if (modalQt > 1) {
        modalQt--;
        q('.pizzaInfo--qt').innerHTML = modalQt;
    }
});
q('.pizzaInfo--qtmais').addEventListener('click', () => {
    modalQt++;
    q('.pizzaInfo--qt').innerHTML = modalQt;
});

qA('.pizzaInfo--size').forEach((tam, tamIndex) => {
    tam.addEventListener('click', (e) => {
        q('.pizzaInfo--size.selected').classList.remove('selected');
        tam.classList.add('selected');
    });
});

q('.pizzaInfo--addButton').addEventListener('click', () => {
    let tamanho = parseInt(q('.pizzaInfo--size.selected').getAttribute('data-key'));
    let ident = pizzaJson[modalKey].id + '@' + tamanho;
    let key = cart.findIndex((item) => item.ident == ident);
    if (key > -1) {
        cart[key].qt += modalQt;
    } else {
        cart.push({
            ident,
            id: pizzaJson[modalKey].id,
            tamanho,
            qt: modalQt
        });
    }
    attCart();
    fecharModal();
});

q('.menu-openner').addEventListener('click', () => {
    if (cart.length > 0) {
        q('aside').style.left = '0';
    }

});
q('.menu-closer').addEventListener('click', () => {
    q('aside').style.left = '100vw';
})

function attCart() {
    q('.menu-openner span').innerHTML = cart.length;
    if (cart.length > 0) {
        q('aside').classList.add('show');
        q('.cart').innerHTML = '';

        let subTotal = 0;
        let desconto = 0;
        let total = 0;

        for (let i in cart) {
            let pizzaItem = pizzaJson.find((item) => item.id == cart[i].id);

            subTotal += pizzaItem.price * cart[i].qt;

            let cartItem = q('.models .cart--item').cloneNode(true);

            switch (cart[i].tamanho) {
                case 0:
                    tamPizzaNome = 'P';
                    break;
                case 1:
                    tamPizzaNome = 'M';
                    break;
                case 2:
                    tamPizzaNome = 'G';
                    break;
            }
            let pizzaName = `${pizzaItem.name} (${tamPizzaNome})`

            cartItem.querySelector('img').src = pizzaItem.img;
            cartItem.querySelector('.cart--item-nome').innerHTML = pizzaName;
            cartItem.querySelector('.cart--item--qt').innerHTML = cart[i].qt;
            cartItem.querySelector('.cart--item-qtmenos').addEventListener('click', () => {

                if (cart[i].qt > 1) {
                    cart[i].qt--;
                } else {
                    cart.splice(i, 1)
                }
                attCart();
            });
            cartItem.querySelector('.cart--item-qtmais').addEventListener('click', () => {
                cart[i].qt++;
                attCart();
            });
            q('.cart').append(cartItem);
        };
        desconto = subTotal * 0.1;
        total = subTotal - desconto;

        q('.subtotal span:last-child').innerHTML = `R$ ${subTotal.toFixed(2)}`;
        q('.desconto span:last-child').innerHTML = `R$ ${desconto.toFixed(2)}`;
        q('.total span:last-child').innerHTML = `R$ ${total.toFixed(2)}`;

    } else {
        q('aside').classList.remove('show');
        q('aside').style.left = '100vw';
    }
}