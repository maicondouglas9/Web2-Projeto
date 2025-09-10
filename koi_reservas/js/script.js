// CARRINHO

const carrinho = document.getElementById("carrinho");
const carrinhoImg = document.getElementById("carrinho-img");
const fecharCarrinho = document.getElementById("fechar-carrinho");
const carrinhoLista = document.getElementById("carrinho-lista");
const btnFinalizar = document.getElementById("finalizar-compra");

btnFinalizar.addEventListener("click", () => {
    if (carrinhoLista.children.length === 0) {
        alert("Seu carrinho está vazio!");
        return;
    }

    let total = document.getElementById("total").textContent;
    alert("Compra finalizada! " + total);


    carrinhoLista.innerHTML = "";
    atualizarTotal();
});

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

    const freteInput = document.getElementById("frete");
    let frete = freteInput ? parseFloat(freteInput.value) : 0;
    if (!isNaN(frete)) total += frete;

    const totalElement = document.getElementById("total");
    if (totalElement) totalElement.textContent = "Total: R$ " + total.toFixed(2).replace(".", ",");
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
      <img src="${imgSrc}" alt="${nome}" 
          style="width:50px; height:50px; object-fit:cover; border-radius:5px; margin-right:10px;">
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

  const botoesAdd = document.querySelectorAll(".btn-add");
  botoesAdd.forEach(botao => {
    botao.addEventListener("click", () => {
      const nome = botao.getAttribute("data-nome");
      const preco = botao.getAttribute("data-preco");
      const img = botao.getAttribute("data-img");
      adicionarAoCarrinho(nome, preco, img);
    });
  });

  const cepInput = document.getElementById("cep");
  if (cepInput) {
    cepInput.addEventListener("input", function(e) {
      let value = e.target.value.replace(/\D/g, ""); 
      if (value.length > 5) {
        e.target.value = value.slice(0, 5) + "-" + value.slice(5, 8);
      } else {
        e.target.value = value;
      }
    });
  }

  const freteInput = document.getElementById("frete");
  if (freteInput) freteInput.addEventListener("change", atualizarTotal);
}

// LOGIN FUNCIONÁRIO

const loginFuncionario = document.getElementById('login-funcionario');
const modalLogin = document.getElementById('modal-login');
const btnLogin = document.getElementById('btn-login');
const btnFecharLogin = document.getElementById('btn-fechar-login');

let funcionarioLogado = false;

if (loginFuncionario) {
  loginFuncionario.addEventListener('click', () => {
    if (!funcionarioLogado && modalLogin) {
      modalLogin.style.display = 'flex';
    }
  });
}

if (btnFecharLogin) {
  btnFecharLogin.addEventListener('click', () => {
    if (modalLogin) modalLogin.style.display = 'none';
  });
}

if (btnLogin) {
  btnLogin.addEventListener('click', () => {
    const usuarioInput = document.getElementById('usuario');
    const senhaInput = document.getElementById('senha');
    const usuario = usuarioInput ? usuarioInput.value : '';
    const senha = senhaInput ? senhaInput.value : '';

    if (usuario === 'admin' && senha === '1234') {
  funcionarioLogado = true;
  if (modalLogin) modalLogin.style.display = 'none';
  if (loginFuncionario) {
    loginFuncionario.textContent = 'Adicionar Prato';
    
  
    loginFuncionario.replaceWith(loginFuncionario.cloneNode(true));
    const novoBotao = document.getElementById('login-funcionario');
    
    
    novoBotao.addEventListener('click', () => {
      window.location.href = 'adicionar-prato.php';
    });
  }
  alert('Login realizado com sucesso!');
}
 else {
      alert('Usuário ou senha incorretos!');
    }
  });
}

// PREVIEW IMAGEM CADASTRO PRATO


const form = document.getElementById('form-prato');
const imagemInput = document.getElementById('imagem-prato');
const preview = document.getElementById('preview-imagem');

if (imagemInput) {
  imagemInput.addEventListener('change', () => {
    const file = imagemInput.files[0];
    if(file){
      const reader = new FileReader();
      reader.onload = function(e){
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

if (form) {
  form.addEventListener('submit', (e) => {
    e.preventDefault();

    const nome = document.getElementById('nome-prato').value;
    const descricao = document.getElementById('descricao-prato').value;
    const preco = document.getElementById('preco-prato').value;

    let imagemData = '';
    if (imagemInput && imagemInput.files[0] && preview) {
      imagemData = preview.src;
    }

    console.log('Prato adicionado:', nome, descricao, preco, imagemData);
    alert('Prato adicionado com sucesso!');

    form.reset();
    if (preview) {
      preview.src = '';
      preview.style.display = 'none';
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

// EXCLUIR PRATO (CARDÁPIO)

document.querySelectorAll(".btn-excluir").forEach(btn => {
  btn.addEventListener("click", () => {
    btn.parentElement.remove();
  });
});
