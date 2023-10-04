import React from "react";

const cardCategorieComponent = (props) => {
    const redirectCategorie = () => {
        window.location.href = "/plats/" + props.categorie.id;
    };
    return (
        <div className="cardCategorie">
            <img src={"build/assets/images/categories/" + props.categorie.image} onClick={redirectCategorie} alt={props.categorie.image} />
            <div>{props.categorie.libelle}</div>
        </div>
    )
};

export default cardCategorieComponent