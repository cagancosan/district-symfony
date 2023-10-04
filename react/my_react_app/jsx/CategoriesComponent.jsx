import React, { useState, useEffect } from "react";
import axios from "axios";
import CardCategorieComponent from "./CardCategorieComponent";

const categoriesComponent = () => {
    const [categories, setCategories] = useState([]);
    const [error, setError] = useState("");
    const [message, setMessage] = useState("Chargement en cours...");

    useEffect(() => {
        axios.get('https://127.0.0.1:8000/api/categories', {
            headers: {
                Accept: "application/json"
            }
        })
            .then((response) => {
                setCategories(response.data);
                setMessage("");
            })
            .catch((error) => {
                setError(`Erreur lors de la requête : ${error.message}`);
                setMessage("");
            });
    }, []);




    return (
        <div>
            {error ? error : ""}
            {message ? message : ""}
            <div className="text-6xl text-visible mb-4">Les catégories</div>
            <div className="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 place-items-center">
                {
                    categories.map((c) => (
                        <CardCategorieComponent key={c.id} categorie={c}></CardCategorieComponent>
                    ))
                }
            </div>
        </div>
    );
};

export default categoriesComponent