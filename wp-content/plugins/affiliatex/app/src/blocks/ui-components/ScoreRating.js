const { RichText } = wp.blockEditor;
const { TextControl } = wp.components;

const RatingNumber = ({ value, label, type, onChange }) => {
	return (
		<>
			{!type && (
				<div className="affx-rating-number">
					<RichText
						tagName="span"
						type="number"
						placeholder="0.0"
						value={value}
						className="affx-rating-num num"
						onChange={onChange}
					/>
					<RichText
						tagName="span"
						type="number"
						placeholder="score label"
						value={label}
						className="affx-rating-number-label label"
					/>
				</div>
			)}
			{type === "circle" && (
				<div className="affx-circle-progress-container">
					<span
						className="circle-wrap"
						style={{
							"--data-deg":
								"rotate(" +
								180 * (((value / 10) * 100) / 100) +
								"deg)",
						}}
					>
						<span className="circle-mask full">
							<span className="fill"></span>
						</span>
						<span className="circle-mask">
							<span className="fill"></span>
						</span>
					</span>
					<TextControl
						type="number"
						placeholder="5"
						value={value.toString()}
						className="affx-circle-inside"
						onChange={onChange}
						hideLabelFromVision={true}
						max={10}
						stepSize={1}
					/>
				</div>
			)}
		</>
	);
};

const SingleRate = ({ value, onChange }) => {
	return (
		<span className="star-rating-single-wrap">
			<TextControl
				type="number"
				placeholder="5"
				value={value.toString()}
				className="affx-pdt-rating"
				onChange={onChange}
				hideLabelFromVision={true}
				max={10}
				stepSize={1}
			/>
		</span>
	);
};

export { RatingNumber, SingleRate };
