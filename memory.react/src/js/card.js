import React from 'react';

const Card = ({ onClick, flipped, value }) => {
    return (
        <div className={`card ${flipped ? 'flipped' : ''}`} onClick={onClick}>
            <div className="card-content">
                {flipped ? '' : <div className="card-background"></div>}
                {flipped ? <img src={value} alt="card" /> : ''}
            </div>
        </div>
    );
};

export default Card;
