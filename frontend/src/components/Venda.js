import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './Venda.css';

const Venda = () => {
    const [produtos, setProdutos] = useState([]);
    const [itens, setItens] = useState([]);
    const [total, setTotal] = useState(0);
    const [totalImpostos, setTotalImpostos] = useState(0);
    const [tipos, setTipos] = useState([]);

    useEffect(() => {
        const fetchTipos = async () => {
            try {
                const response = await axios.get('/api/tipos');
                setTipos(response.data);
            } catch (error) {
                console.error('Erro ao buscar tipos de produto', error);
            }
        };

        fetchTipos();
    }, []);

    useEffect(() => {
        const fetchProdutos = async () => {
            try {
                const response = await axios.get('/api/produtos');
                setProdutos(response.data);
            } catch (error) {
                console.error('Erro ao buscar produtos', error);
            }
        };

        fetchProdutos();
    }, []);

    const handleAddItem = () => {
        setItens([...itens, { produtoId: '', quantidade: 1 }]);
    };

    const handleItemChange = (index, field, value) => {
        const newItens = itens.slice();
        newItens[index][field] = value;
        setItens(newItens);
        calculateTotal(newItens);
    };

    const calculateTotal = (itens) => {
        let newTotal = 0;
        let newTotalImpostos = 0;
        itens.forEach(item => {
            const produto = produtos.find(p => p.id === parseInt(item.produtoId));
            if (produto) {
                const tipo = tipos.find(t => t.id === parseInt(produto.tipo_id));
                const subtotal = produto.preco * item.quantidade;
                const imposto = (tipo.imposto_percentual / 100) * subtotal;
                newTotal += subtotal;
                newTotalImpostos += imposto;
                item.subtotal = subtotal;
                item.imposto = imposto;
            }
        });
        setTotal(newTotal);
        setTotalImpostos(newTotalImpostos);
    };

    const handleSubmit = async (event) => {
        event.preventDefault();
        try {
            await axios.post('/api/vendas', {
                itens:itens.map(item => ({
                  produto_id: item.produtoId,
                  quantidade: item.quantidade,
                  subtotal: item.subtotal,
                  imposto: item.imposto
              }))
            });
            alert('Venda realizada com sucesso!');
            setItens([]);
            setTotal(0);
            setTotalImpostos(0);
        } catch (error) {
            console.error('Erro ao realizar venda', error.response ? error.response.data : error.message);
            alert('Erro ao realizar venda');
        }
    };

    return (
        <div className="venda">
            <h2>Realizar Venda</h2>
            <form onSubmit={handleSubmit}>
                {itens.map((item, index) => (
                    <div key={index}>
                        <label>Produto:</label>
                        <select
                            value={item.produtoId}
                            onChange={(e) => handleItemChange(index, 'produtoId', e.target.value)}
                            required
                        >
                            <option value="">Selecione um produto</option>
                            {produtos.map((produto) => (
                                <option key={produto.id} value={produto.id}>
                                    {produto.nome}
                                </option>
                            ))}
                        </select>
                        <label>Quantidade:</label>
                        <input
                            type="number"
                            min="1"
                            value={item.quantidade}
                            onChange={(e) => handleItemChange(index, 'quantidade', e.target.value)}
                            required
                        />
                    </div>
                ))}
                <button type="button" onClick={handleAddItem}>Adicionar Produto</button>
                <button type="submit"style={{ marginTop: "8px" }}>Finalizar Venda</button>
            </form>
            <div className="venda-total">
                <p>Total: R${total.toFixed(2)}</p>
                <p>Total de Impostos: R${totalImpostos.toFixed(2)}</p>
            </div>
        </div>
    );
};

export default Venda;
