import React from 'react';
import { Link } from 'react-router-dom';
import './WelcomeScreen.css'; // Arquivo CSS para estilização

const WelcomeScreen = () => {
    return (
        <div className="welcome-screen">
            <h2>Bem-vindo ao Sistema de Vendas</h2>
            <p>Escolha uma das opções abaixo para continuar:</p>
            <div className="actions">
                <Link to="/cadastro-produto" className="action-button">Cadastro de Produto</Link>
                <Link to="/cadastro-tipo" className="action-button">Cadastro de Tipo de Produto</Link>
                <Link to="/venda" className="action-button">Realizar Venda</Link>
            </div>
        </div>
    );
};

export default WelcomeScreen;
