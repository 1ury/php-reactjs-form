import React, { useState } from 'react';
import axios from 'axios';
import './CadastroTipo.css';

const CadastroTipo = () => {
    const [nome, setNome] = useState('');
    const [imposto, setImposto] = useState('');

    const handleSubmit = async (event) => {
        event.preventDefault();
        try {
            await axios.post('/api/tipos', {
                nome,
                imposto
            });
            alert('Tipo de produto cadastrado com sucesso!');
            setNome('');
            setImposto('');
        } catch (error) {
            console.error('Erro ao cadastrar tipo de produto', error.response ? error.response.data : error.message);
            alert('Erro ao cadastrar tipo de produto');
        }
    };

    return (
        <div className="cadastro-tipo">
            <h2>Cadastro de Tipo de Produto</h2>
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
                    <label>Imposto (%):</label>
                    <input
                        type="number"
                        step="0.01"
                        value={imposto}
                        onChange={(e) => setImposto(e.target.value)}
                        required
                    />
                </div>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    );
};

export default CadastroTipo;
