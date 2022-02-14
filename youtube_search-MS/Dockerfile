FROM node:14-alpine as base

WORKDIR /src
COPY package*.json /
EXPOSE 5001

FROM base as dev
ENV NODE_ENV=development
RUN npm install -g nodemon && npm install
COPY . /
CMD ["npm", "run", "start:dev"]
