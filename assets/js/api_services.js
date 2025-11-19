/**
 * SERVIÇOS DE API (ViaCEP e QuickChart)
 */

const ApiService = {

    // API 1: ViaCEP (Simulador de Frete)
    consultarFrete: async function(inputId, resultId) {
        const cepInput = document.getElementById(inputId);
        const resultDiv = document.getElementById(resultId);
        const cep = cepInput.value.replace(/\D/g, '');

        if (cep.length !== 8) {
            resultDiv.innerHTML = '<span class="text-danger fw-bold">CEP inválido.</span>';
            return;
        }

        resultDiv.innerHTML = '<span class="text-muted"><i class="bi bi-hourglass-split"></i> Buscando...</span>';

        try {
            const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
            const data = await response.json();

            if (data.erro) {
                resultDiv.innerHTML = '<span class="text-danger fw-bold">CEP não encontrado.</span>';
            } else {
                resultDiv.innerHTML = `
                    <div class="mt-2 p-2 bg-success bg-opacity-10 border border-success rounded text-success">
                        <i class="bi bi-geo-alt-fill"></i> <strong>${data.localidade} / ${data.uf}</strong><br>
                        <span class="badge bg-success mt-1">FRETE GRÁTIS - BLACK FRIDAY</span>
                    </div>
                `;
            }
        } catch (error) {
            resultDiv.innerHTML = '<span class="text-danger">Erro de conexão.</span>';
        }
    },

    // API 2: QuickChart (Helper para o Modal de Histórico)
    gerarQrCodePix: function(pedidoId, valor, imgId, modalTitleId) {
        document.getElementById(modalTitleId).innerText = `Pagamento Pedido #${pedidoId}`;
        
        const conteudoPix = `Pagamento_ByteShop_Pedido_${pedidoId}_Valor_${valor}`;
        const urlApi = `https://quickchart.io/qr?text=${conteudoPix}&size=300&margin=2&dark=000000&light=ffffff`;

        const imgElement = document.getElementById(imgId);
        imgElement.src = urlApi;
    }
};