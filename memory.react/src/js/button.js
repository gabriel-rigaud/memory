import React from 'react';

const Button = ({ onClick, text, imageUrl }) => {
    return (
        <button onClick={onClick}>
            {text}
            {imageUrl && <img src={imageUrl} alt="icon" />}
        </button>
    );
};

export default Button;
