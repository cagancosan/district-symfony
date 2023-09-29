import React, { useState, useEffect } from "react";
import axios from "axios";

const MonPremierComposant = () => {
    const [responseData, setResponseData] = useState(null);
    const [error, setError] = useState(null);
    useEffect(() => {
        const credentials = {
            email: 'xxxxx@gmail.com',
            password: 'xxxxx'
        };

        const headers = {
            'Content-Type': 'application/json'
        };
        axios.post('https://127.0.0.1:8000/api/login_check', credentials, { headers })
            .then((response) => {
                if (response.status === 200) {
                    const token = response.data.token;
                    axios.get('https://127.0.0.1:8000/api/categories', {
                        headers: {
                            Authorization: `Bearer ${token}`,
                        },
                    })
                        .then((response) => {
                            setResponseData(response.data);
                        })
                        .catch((error) => {
                            setError(`Erreur lors de la requête avec le token Bearer : ${error.message}`);
                        });
                } else {
                    setError(`Échec de l'authentification : ${response.status} ${response.statusText}`);
                }
            })
            .catch((error) => {
                setError(`Erreur lors de la récupération du token : ${error.message}`);
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