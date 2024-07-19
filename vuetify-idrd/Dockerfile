FROM node:16

# Set working directory
WORKDIR /app

# Copy package.json and yarn.lock
COPY package.json yarn.lock ./

# Install dependencies
RUN yarn install

# Copy the rest of the application code
COPY . .

# Expose port 8080
EXPOSE 8080

# Start the application
CMD ["yarn", "serve"]