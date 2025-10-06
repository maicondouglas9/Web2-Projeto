// CARRINHO
const carrinho = document.getElementById("carrinho");
const carrinhoImg = document.getElementById("carrinho-img");
const fecharCarrinho = document.getElementById("fechar-carrinho");
const carrinhoLista = document.getElementById("carrinho-lista");

if (carrinhoImg && carrinho && fecharCarrinho && carrinhoLista) {
  carrinhoImg.addEventListener("click", () => {
    carrinho.classList.toggle("ativo");
  });

  fecharCarrinho.addEventListener("click", () => {
    carrinho.classList.remove("ativo");
  });

  function atualizarTotal() {
    let total = 0;
    carrinhoLista.querySelectorAll("li").forEach(item => {
      let preco = parseFloat(item.querySelector(".preco").textContent.replace("R$ ", "").replace(",", "."));
      let qtd = parseInt(item.querySelector(".qtd").textContent);
      total += preco * qtd;
    });
    const totalElement = document.getElementById("total");
    if (totalElement) totalElement.textContent = "Total: R$ " + total.toFixed(2).replace(".", ",");
    return total;
  }

  function adicionarAoCarrinho(nome, preco, imgSrc) {
    let itens = carrinhoLista.querySelectorAll("li");
    for (let item of itens) {
      if (item.getAttribute("data-nome") === nome) {
        let qtdSpan = item.querySelector(".qtd");
        qtdSpan.textContent = parseInt(qtdSpan.textContent) + 1;
        atualizarTotal();
        return;
      }
    }

    let li = document.createElement("li");
    li.setAttribute("data-nome", nome);
    li.style.display = "flex";
    li.style.alignItems = "center";
    li.style.justifyContent = "space-between";
    li.innerHTML = `
      <img src="${imgSrc}" alt="${nome}" style="width:50px; height:50px; object-fit:cover; border-radius:5px; margin-right:10px;">
      <div style="flex:1;">
        <strong>${nome}</strong><br>
        <span class="preco">R$ ${preco}</span>
      </div>
      <div class="qtd-container">
        <button class="btn-menos">-</button>
        <span class="qtd">1</span>
        <button class="btn-mais">+</button>
      </div>
      <button class="btn-remover">❌</button>
    `;
    carrinhoLista.appendChild(li);

    const btnMais = li.querySelector(".btn-mais");
    const btnMenos = li.querySelector(".btn-menos");
    const qtdSpan = li.querySelector(".qtd");
    const btnRemover = li.querySelector(".btn-remover");

    btnMais.addEventListener("click", () => {
      qtdSpan.textContent = parseInt(qtdSpan.textContent) + 1;
      atualizarTotal();
    });

    btnMenos.addEventListener("click", () => {
      let qtd = parseInt(qtdSpan.textContent);
      if (qtd > 1) {
        qtdSpan.textContent = qtd - 1;
      } else {
        li.remove();
      }
      atualizarTotal();
    });

    btnRemover.addEventListener("click", () => {
      li.remove();
      atualizarTotal();
    });

    atualizarTotal();
  }

  document.querySelectorAll(".btn-add").forEach(botao => {
    botao.addEventListener("click", () => {
      const nome = botao.getAttribute("data-nome");
      const preco = botao.getAttribute("data-preco");
      const img = botao.getAttribute("data-img");
      adicionarAoCarrinho(nome, preco, img);
    });
  });


  const finalizarCompra = document.getElementById("finalizar-compra");
  if (finalizarCompra) {
    finalizarCompra.addEventListener("click", () => {
      let itens = [];
      carrinhoLista.querySelectorAll("li").forEach(item => {
        itens.push({
          nome: item.getAttribute("data-nome"),
          qtd: parseInt(item.querySelector(".qtd").textContent),
          preco: parseFloat(item.querySelector(".preco").textContent.replace("R$ ", "").replace(",", "."))
        });
      });

      let total = atualizarTotal();


      fetch("checkout.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ itens, total })
      }).then(() => {
        window.location.href = "checkout.php";
      });
    });
  }
}


// LOGIN FUNCIONÁRIO
const loginFuncionario = document.getElementById('login-funcionario');
const modalLogin = document.getElementById('modal-login');
const btnLogin = document.getElementById('btn-login');
const btnFecharLogin = document.getElementById('btn-fechar-login');

let funcionarioLogado = false;

if (loginFuncionario) {
  loginFuncionario.addEventListener('click', () => {
    if (!funcionarioLogado && modalLogin) modalLogin.style.display = 'flex';
  });
}

if (btnFecharLogin) {
  btnFecharLogin.addEventListener('click', () => {
    if (modalLogin) modalLogin.style.display = 'none';
  });
}

if (btnLogin) {
  btnLogin.addEventListener('click', () => {
    const usuario = document.getElementById('usuario').value;
    const senha = document.getElementById('senha').value;

    fetch('login-funcionario.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `usuario=${encodeURIComponent(usuario)}&senha=${encodeURIComponent(senha)}`
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          modalLogin.style.display = 'none';
          alert('Login realizado com sucesso!');
          window.location.reload();
        } else {
          alert(data.msg);
        }
      }).catch(err => console.error(err));
  });
}


// PREVIEW IMAGEM PRATO
const imagemInput = document.getElementById('imagem-prato');
const preview = document.getElementById('preview-imagem');

if (imagemInput) {
  imagemInput.addEventListener('change', () => {
    const file = imagemInput.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        if (preview) {
          preview.src = e.target.result;
          preview.style.display = 'block';
        }
      }
      reader.readAsDataURL(file);
    } else {
      if (preview) {
        preview.src = '';
        preview.style.display = 'none';
      }
    }
  });
}

// FORMATAR PREÇO
function formatarPreco(input) {
  let valor = input.value;
  valor = valor.replace(/[^\d,]/g, '');
  valor = valor.replace(',', '.');
  let partes = valor.split('.');
  if (partes[0].length > 3) partes[0] = partes[0].substring(0, 3);
  if (partes[1]) partes[1] = partes[1].substring(0, 2);
  input.value = partes.join(',');
}

// CONFIRMAÇÃO DE EXCLUSÃO
document.addEventListener("click", function (e) {
  const btnExcluir = e.target.closest(".btn-excluir");
  if (!btnExcluir) return;

  e.preventDefault();

  if (!confirm("Deseja realmente excluir?")) return;


  const link = btnExcluir.closest("a");
  if (link && link.href) {
    window.location.href = link.href;
    return;
  }



  const form = btnExcluir.closest("form");
  if (form) form.submit();
});

