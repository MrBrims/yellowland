export function calc() {

    let cacheData = null;

    function fetchData() {
        if (cacheData) {
            return Promise.resolve(cacheData);
        }

        return fetch(window.location.origin + '/wp-json/my-data/v2/pricelist') // Используем относительный путь
            .then((response) => response.json())
            .then((data) => {
                cacheData = data;
                return data;
            })
            .catch((error) => {
                console.error("Failed to fetch pricelist:", error);
                return null;
            });
    }


    const calcElements = document.querySelectorAll('.js-calc');

    fetchData()
        .then((data) => {
            if (!data) {
                return;
            }

            calcElements.forEach((calc) => {
                const price = calc.querySelector(".js-price");
                const type = calc.querySelector('[name="type"]');
                const spec = calc.querySelector('[name="specialization"]');
                const num = calc.querySelector('.form-counter');
                const numInput = num.querySelector('input');

                type.addEventListener("change", (e) => {
                    calculation(e.target.value, spec.value, numInput.value, data);
                });
                spec.addEventListener("change", (e) => {
                    calculation(type.value, e.target.value, numInput.value, data);
                });
                num.addEventListener("change", (e) => {
                    calculation(type.value, spec.value, e.target.value, data);
                });
                num.addEventListener("click", (e) => {
                    calculation(type.value, spec.value, numInput.value, data);
                });

                function calculation(type, spec, quantity, data) {
                    let b = false;
                    data.forEach((el) => {
                        if (el.specialties.includes(spec)) {
                            el.prices.forEach((t) => {
                                if (t.name === type) {
                                    price.innerHTML = "ab <span>" + t.perOneMin * quantity + " €</span>";
                                    b = true;
                                }
                            });
                        }
                    });
                    if (!b) {
                        price.innerHTML = "ab <span>49,00 €</span>";
                    }
                }
            });
        });
}