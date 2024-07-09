import React from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import CadastroProduto from './components/CadastroProduto';
import CadastroTipo from './components/CadastroTipo';
import Venda from './components/Venda';
import WelcomeScreen from './components/WelcomeScreen';

function App() {
  return (
    <Router>
      <div className="App">
        <Routes>
          <Route path="/" exact element={<WelcomeScreen />} />
          <Route path="/cadastro-produto" element={<CadastroProduto />} />
          <Route path="/cadastro-tipo" element={<CadastroTipo />} />
          <Route path="/venda" element={<Venda />} />
        </Routes>
      </div>
    </Router>
  );
}

export default App;
