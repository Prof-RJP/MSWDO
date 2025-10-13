
// Define the Alpine component
window.cameraApp = function () {
    return {
        /* =======================
           💾 VARIABLES
           ======================= */
        video: null,   // Reference to <video> tag
        photo: '',     // Base64 string of captured image
        stream: null,  // Media stream object

        /* =======================
           🎥 INITIALIZE CAMERA
           ======================= */
        async initCamera() {
            try {
                // Get <video> element reference from Blade (x-ref="video")
                this.video = this.$refs.video

                // Ask for permission to access webcam
                this.stream = await navigator.mediaDevices.getUserMedia({ video: true })

                // Display the live stream in the <video> element
                this.video.srcObject = this.stream
            } catch (error) {
                alert('Unable to access camera. Please allow permission.')
            }
        },

        /* =======================
           📸 CAPTURE PHOTO
           ======================= */
        capturePhoto() {
            // Create a <canvas> element to draw current video frame
            const canvas = document.createElement('canvas')
            canvas.width = this.video.videoWidth
            canvas.height = this.video.videoHeight

            // Copy the current frame from video to canvas
            const context = canvas.getContext('2d')
            context.drawImage(this.video, 0, 0, canvas.width, canvas.height)

            // Convert canvas image to base64 string
            this.photo = canvas.toDataURL('image/png')

            // This automatically updates the preview and the hidden input
        },

        /* =======================
           🔄 RETAKE PHOTO
           ======================= */
        retakePhoto() {
            // Clear the captured photo
            this.photo = ''
        }
    }
}


