import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './CadastroProduto.css';

const CadastroProduto = () => {
    const [nome, setNome] = useState('');
    const [tipoId, setTipoId] = useState('');
    const [preco, setPreco] = useState('');
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
    const handleSubmit = async (event) => {
        event.preventDefault();
        try {
            console.log('Enviando dados:', { nome, tipo_id: tipoId, preco });
            const response = await axios.post('/api/produtos', {
                nome,
                tipo_id: tipoId,
                preco
            });
            console.log('Resposta do servidor:', response.data);
            alert('Produto cadastrado com sucesso!');
        } catch (error) {
            console.error('Erro ao cadastrar produto', error.response ? error.response.data : error.message);
            alert('Erro ao cadastrar produto');
        }
    };

    return (
        <div className="cadastro-produto">
            <h2>Cadastro de Produto</h2>
            <form onSubmit={handleSubmit}>
                <div>
                    <label>Nome:</label>
                    <input
                        type="text"
                        value={nome}
                        onChange={(e) => setNome(e.target.value)}
                        required
                    />
                </div>
                <div>
                    <label>Tipo:</label>
                    <select
                        value={tipoId}
                        onChange={(e) => setTipoId(e.target.value)}
                        required
                    >
                        <option value="">Selecione um tipo</option>
                        {tipos.map((tipo) => (
                            <option key={tipo.id} value={tipo.id}>
                                {tipo.nome}
                            </option>
                        ))}
                    </select>
                </div>
                <div>
                    <label>Preço:</label>
                    <input
                        type="number"
                        step="0.01"
                        value={preco}
                        onChange={(e) => setPreco(e.target.value)}
                        required
                    />
                </div>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    );
};

export default CadastroProduto;
