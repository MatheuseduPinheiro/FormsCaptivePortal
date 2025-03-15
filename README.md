# Captive Portal

## Visão Geral

Este projeto configura um Captive Portal utilizando um Raspberry Pi como Access Point (AP) com OpenWrt. O AP é conectado via Ethernet a um roteador que fornece acesso à internet e gerencia a distribuição de IPs via DHCP. Dispositivos clientes (celulares, notebooks, etc.) podem se conectar ao AP via Wi-Fi e são redirecionados para a página de autenticação do portal cativo.

![rasp](https://github.com/user-attachments/assets/1202b413-868b-4282-a2a6-257e0b9cccdf)

## Funcionamento

Com base na imagem, o Raspberry Pi foi configurado como um Access Point (AP) utilizando OpenWrt. Ele está conectado via cabo Ethernet a um roteador ISP, que distribui IPs para os dispositivos conectados. O AP gerencia a conexão de outros dispositivos genéricos (como celulares e computadores) via Wi-Fi.

![funcionamento](https://github.com/user-attachments/assets/be220e70-2fb5-4c0a-bd89-c37fa601b3a2)

## Observação

O layout de **Login** e **Cadastro** pode ser melhorado para otimizar a usabilidade e a estética da interface. Certifique-se de que o design seja claro, responsivo e fácil de usar.

