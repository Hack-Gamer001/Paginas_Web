// twitchApi.js

// Client ID de Twitch
const clientId = 'vebe9ujh77lxqn48vg4c1x0fmj4ijv';

// Nombre de usuario de Twitch
const username = 'upminaa';

// Función para obtener datos de Twitch
async function fetchTwitchData() {
    try {
        // Obtener el ID del usuario
        const userResponse = await fetch(`https://api.twitch.tv/helix/users?login=${username}`, {
            headers: {
                'Client-ID': clientId
            }
        });

        const userData = await userResponse.json();
        const userId = userData.data[0].id;

        // Obtener el número de seguidores
        const followersResponse = await fetch(`https://api.twitch.tv/helix/channels/followers?broadcaster_id=${userId}&first=1`, {
            headers: {
                'Client-ID': clientId
            }
        });

        const followersData = await followersResponse.json();
        const followersCount = followersData.total;

        // Obtener el número de streams
        const streamsResponse = await fetch(`https://api.twitch.tv/helix/streams?user_id=${userId}`, {
            headers: {
                'Client-ID': clientId
            }
        });

        const streamsData = await streamsResponse.json();
        const streamsCount = streamsData.data.length;

        // Actualizar el HTML con los datos obtenidos
        document.querySelector('.hero__stat-number:nth-child(1)').textContent = followersCount.toLocaleString();
        document.querySelector('.hero__stat-number:nth-child(2)').textContent = streamsCount;

    } catch (error) {
        console.error('Error al obtener datos de Twitch:', error);
    }
}

// Llama a la función para obtener los datos cuando el DOM esté cargado
document.addEventListener('DOMContentLoaded', fetchTwitchData);
