FROM node:10.10-alpine

RUN mkdir -p /usr/src/client-react

WORKDIR /usr/src/client-react

RUN yarn global add @api-platform/client-generator

# Prevent the reinstallation of node modules at every changes in the source code
COPY package.json yarn.lock ./
RUN yarn install

COPY . ./

CMD yarn start
