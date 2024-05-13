import React, { useState, useEffect } from 'react';
import Title from './title.js';
import Button from './button.js';
import Card from './card.js';

const MemoryGame = () => {
    const [cards, setCards] = useState([]);
    const [flippedIndices, setFlippedIndices] = useState([]);
    const [matchedIndices, setMatchedIndices] = useState([]);
    const [victory, setVictory] = useState(false);
    const [moves, setMoves] = useState(0);

    useEffect(() => {
        initializeGame();
    }, []);

    const initializeGame = () => {
        const symbols = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
        const initialCards = symbols
            .concat(symbols)
            .map((symbol, index) => ({ id: index, symbol, flipped: false }));

        // Shuffle the cards
        initialCards.sort(() => Math.random() - 0.5);

        setCards(initialCards);
        setFlippedIndices([]);
        setMatchedIndices([]);
        setVictory(false);
        setMoves(0);
    };

    const handleCardClick = (index) => {
        if (flippedIndices.length === 2 || matchedIndices.includes(index)) return;

        setFlippedIndices([...flippedIndices, index]);

        if (flippedIndices.length === 1) {
            setTimeout(() => checkForMatch(), 1000);
            setMoves(moves + 1);
        }
    };

    const checkForMatch = () => {
        const [firstIndex, secondIndex] = flippedIndices;
        const newCards = [...cards];

        if (cards[firstIndex].symbol === cards[secondIndex].symbol) {
            setMatchedIndices([...matchedIndices, firstIndex, secondIndex]);
        }

        newCards[firstIndex].flipped = false;
        newCards[secondIndex].flipped = false;

        setCards(newCards);
        setFlippedIndices([]);
        checkForVictory();
    };

    const checkForVictory = () => {
        if (matchedIndices.length === cards.length) {
            setVictory(true);
        }
    };

    const handleRestart = () => {
        initializeGame();
    };

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
};

export default MemoryGame;
