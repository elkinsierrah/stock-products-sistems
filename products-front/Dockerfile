FROM node:lts-alpine AS builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build
FROM nginx:1.23.3-alpine
RUN rm /etc/nginx/conf.d/default.conf
COPY ./nginx-custom.conf /etc/nginx/conf.d/default.conf
COPY --from=builder /app/dist /usr/share/nginx/html
EXPOSE 80