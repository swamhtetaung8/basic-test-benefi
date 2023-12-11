FROM node:21.4.0-alpine3.17

WORKDIR /frontend

COPY . .

RUN npm install

EXPOSE 5173

CMD ["npm", "run", "dev"]
