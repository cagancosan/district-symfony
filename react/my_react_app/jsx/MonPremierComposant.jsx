import React, { useState, useEffect } from "react";
import axios from "axios";

const MonPremierComposant = () => {
    const [responseData, setResponseData] = useState(null);
    const [error, setError] = useState(null);
    useEffect(() => {
        axios.get('https://127.0.0.1:8000/api/categories')
            .then((response) => {
                setResponseData(response.data);
            })
            .catch((error) => {
                setError(`Erreur lors de la requête : ${error.message}`);
            });
    }, []);

    if (error) {
        return <div>Erreur : {error}</div>;
    }

    if (responseData) {
        return (
            <div>
                <pre>{JSON.stringify(responseData['hydra:member'], null, 2)}</pre>
            </div>
        );
    }

    return <div>Chargement en cours...</div>;
};

export default MonPremierComposant