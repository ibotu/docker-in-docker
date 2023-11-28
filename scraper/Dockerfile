# Use a Python base image
FROM python:3.9

# Set the working directory in the container
WORKDIR /app

COPY requirements.txt /app

# Install any dependencies if needed (e.g., requests library)
RUN pip install -r requirements.txt

# Define the volume
VOLUME /app

# Copy the scraper application code into the container
COPY ./app /app

# Specify the command to run the scraper continuously (modify this to your needs)
CMD ["python", "scraper.py"]
