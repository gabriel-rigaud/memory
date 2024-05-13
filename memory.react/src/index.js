import React from 'react';
import ReactDOM from 'react-dom';
import './styles.css'; // Assurez-vous d'importer votre fichier de styles principal ici
import App from './app'; // Assurez-vous que le chemin est correct pour votre composant principal

ReactDOM.render(
    <React.StrictMode>
        <App /> {/* Ou MemoryGame si vous avez choisi ce nom */}
    </React.StrictMode>,
    document.getElementById('root')
);