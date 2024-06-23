const popup_search = document.querySelector("#popup_search");
const  show_popup_search = document.querySelector("#show_popup_search");
const popup_search_inner_container = popup_search.querySelector(".inner_container");
const search_result = document.querySelector("#search_result");

show_popup_search.addEventListener("click", () => {
    popup_search.classList.add("active");
});

popup_search.addEventListener("click", () => {
    popup_search.classList.remove("active");
});

document.querySelector("#search").addEventListener("click", (event) => {
    event.preventDefault();
    let query = document.querySelector("#query").value;
    let data = new FormData();
    data.append("query", query);
    fetch("ajax/search.php", {
        method: "POST",
        body: data,
    }).then(response => response.json()).then(json => {
        search_result.innerHTML = "";
        if (json.status) {
            for (let good of json.goods) {
                let a = document.createElement("a");
                a.href = `good.php?id=${good.id}`;
                a.classList.add("good");
                a.innerHTML = `
                    <div class="image">
                        <img src="assets/goods/${good.Cover}" alt="">
                    </div>
                    <div class="text">
                        <p class="name">${good.Name}</p>
                    </div>
                    <div class="price">
                        <p>${parseFloat(good.Price).toLocaleString("ru-RU")}</p>
                    </div>`;
                search_result.appendChild(a);
            }
        }
    } );
});

popup_search_inner_container.addEventListener("click", (event) => {
    event.stopPropagation();
});

const popup_login = document.querySelector("#popup_login");
const  show_popup_login = document.querySelector("#show_popup_login");
const popup_login_inner_container = popup_login.querySelector(".inner_container");

show_popup_login.addEventListener("click", () => {
    popup_login.classList.add("active");
});

popup_login.addEventListener("click", () => {
    popup_login.classList.remove("active");
});

popup_login_inner_container.addEventListener("click", (event) => {
    event.stopPropagation();
});

document.querySelectorAll(".add_to_cart").forEach( button => {
   button.addEventListener("click", async function (event) {
       event.preventDefault();
       let good_id = this.getAttribute("data-id");
       let data = new FormData();
       data.append("good_id", good_id);
       const res = await fetch("ajax/add_to_cart.php", {
           method: "POST",
           body: data,
       });
       if (res.ok) {
           console.log(this)
           this.textContent = 'dasdsa';
       }
   })
});
