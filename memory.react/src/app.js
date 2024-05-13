import React, { useState, useEffect } from 'react';
import Title from './js/title';
import Button from './js/button';
import Card from './js/card';
import './styles.css';

function App() {
    const [cards, setCards] = useState([]);
    const [flippedIndices, setFlippedIndices] = useState([]);
    const [matchedIndices, setMatchedIndices] = useState([]);
    const [victory, setVictory] = useState(false);
    const [moves, setMoves] = useState(0);

    useEffect(() => {
        initializeGame();
    }, []);

    function initializeGame() {
        const imageNames = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
        const initialCards = imageNames
            .concat(imageNames)
            .map((imageName, index) => ({ id: index, symbol: `/${imageName}.jpg`, flipped: false })); // Utilisation des noms de fichiers des images

        initialCards.sort(() => Math.random() - 0.5);

        setCards(initialCards);
        setFlippedIndices([]);
        setMatchedIndices([]);
        setVictory(false);
        setMoves(0);
    }


    function handleCardClick(index) {
        if (flippedIndices.length === 2 || matchedIndices.includes(index)) return;

        setFlippedIndices([...flippedIndices, index]);

        if (flippedIndices.length === 1) {
            setTimeout(() => checkForMatch(), 1000);
            setMoves(moves + 1);
        }
    }

    function checkForMatch() {
        const [firstIndex, secondIndex] = flippedIndices;
        const newCards = [...cards];

        // Vérifier si les indices sont valides
        if (cards[firstIndex] && cards[secondIndex]) {
            if (cards[firstIndex].symbol === cards[secondIndex].symbol) {
                setMatchedIndices([...matchedIndices, firstIndex, secondIndex]);
            }

            newCards[firstIndex].flipped = false;
            newCards[secondIndex].flipped = false;
        }

        setCards(newCards);
        setFlippedIndices([]);
        checkForVictory();
    }

    function checkForVictory() {
        if (matchedIndices.length === cards.length) {
            setVictory(true);
        }
    }

    function handleRestart() {
        initializeGame();
    }

    return (
        <div className="memory-game">
            <Title text="Memory Game" />
            <div className="cards-grid">
                {cards.map((card, index) => (
                    <Card
                        key={card.id}
                        onClick={() => handleCardClick(index)}
                        flipped={flippedIndices.includes(index) || matchedIndices.includes(index)}
                        value={card.symbol}
                    />
                ))}
            </div>
            <div className="info">
                <p>Moves: {moves}</p>
                {victory && <p>Congratulations! You've won!</p>}
                <Button onClick={handleRestart} text="Restart" />
            </div>
        </div>
    );
}

export default App;
